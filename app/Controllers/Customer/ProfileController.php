<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    protected $customerModel;
    public function __construct()
    {
        $this->customerModel = new Customer();
    }
    public function index()
    {
        $customerId = session()->get('customer_id');

        if (!$customerId) {
            return redirect()->to('/logins')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = $this->customerModel->find($customerId);

        if (!$customer) {
            return redirect()->to('/logins')->with('error', 'Akun tidak ditemukan');
        }

        return view('customers/profile', ['customer' => $customer]);
    }
    public function update()
    {
        $customerId = session()->get('customer_id');

        if (!$customerId) {
            return redirect()->to('/logins')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = $this->customerModel->find($customerId);

        if (!$customer) {
            return redirect()->to('/logins')->with('error', 'Akun tidak ditemukan');
        }

        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]', // Password opsional, minimal 6 karakter jika diisi
            'image'    => 'is_image[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg,image/jpg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan dalam pengisian form');
        }

        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/customers/', $newName);
            if ($customer['image'] && file_exists('uploads/customers/' . $customer['image'])) {
                unlink('uploads/customers/' . $customer['image']);
            }
        } else {
            $newName = $customer['image'];
        }

        // Periksa apakah password diisi
        $password = $this->request->getPost('password');
        $updateData = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'image' => $newName,
        ];

        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->customerModel->update($customerId, $updateData);

        // **Perbarui session setelah update**
        session()->set([
            'name'  => $updateData['name'],
            'email' => $updateData['email'],
            'image' => $newName,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
