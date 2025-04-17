<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Customer;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class ProfileController extends BaseController
{
    protected $customerModel;
    protected $blade;

    public function __construct()
    {
        $this->customerModel = new UserModel(); // Harus pakai UserModel dari Myth\Auth
        $this->blade = new BladeOneLibrary();   // Pastikan ini benar
    }

    public function index()
    {
        $customerId = session()->get('logged_in');
        $role = session()->get('role');

        if (!$customerId) {
            return redirect()->to('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($role !== 'customer') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk pelanggan.');
        }

        $customer = $this->customerModel->find($customerId);

        if (!$customer) {
            return redirect()->to('login')->with('error', 'Akun tidak ditemukan.');
        }

        return $this->blade->render('customers.profile', ['customer' => $customer]);
    }



    public function update()
    {
        $customerId = session()->get('logged_in');

        if (!$customerId) {
            return redirect()->to('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = $this->customerModel->find($customerId);

        if (!$customer) {
            return redirect()->to('login')->with('error', 'Akun tidak ditemukan');
        }

        $rules = [
            'username' => 'min_length[3]',
            'email'    => 'valid_email',
            'password' => 'permit_empty|min_length[6]',
            'image'    => 'permit_empty|is_image[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg,image/jpg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan dalam pengisian form');
        }

        $updateData = [];

        // Cek perubahan username
        $newUsername = $this->request->getPost('username');
        if ($newUsername !== $customer->username) {
            $updateData['username'] = $newUsername;
        }

        // Cek perubahan email
        $newEmail = $this->request->getPost('email');
        if ($newEmail !== $customer->email) {
            $updateData['email'] = $newEmail;
        }

        // Cek perubahan password
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Cek upload gambar
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newImage = $file->getRandomName();
            $file->move('uploads/customers/', $newImage);

            // Hapus gambar lama
            if (!empty($customer->image) && file_exists('uploads/customers/' . $customer->image)) {
                unlink('uploads/customers/' . $customer->image);
            }

            $updateData['image'] = $newImage;
        }

        // Hanya update jika ada perubahan
        if (!empty($updateData)) {
            $this->customerModel->update($customerId, $updateData);
        }

        // Update session dengan data terbaru
        session()->set([
            'username' => $updateData['username'] ?? $customer->username,
            'email'    => $updateData['email'] ?? $customer->email,
            'image'    => $updateData['image'] ?? $customer->image,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
