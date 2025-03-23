<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Customer();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('/destination'));
        }
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('/transactions'));
        }

        $data = [
            'title' => 'Login | Seri Tutorial CodeIgniter 4: Login dan Register @ qadrlabs.com'
        ];

        return view('customers/auth//login', $data);
    }

    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    public function login()
    {
        $data = $this->request->getPost(['email', 'password']);

        if (! $this->validateData($data, [
            'email' => 'required',
            'password' => 'required'
        ])) {
            return $this->index();
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari customer berdasarkan email
        $customer = $this->model->where('email', $email)->first();

        if (! $customer || ! password_verify($password, $customer['password'])) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back();
        }

        // Simpan data customer ke session
        $sessionData = [
            'customer_id'   => $customer['id'], // ID customer dari database
            'name'      => $customer['name'],
            'email'     => $customer['email'],
            'image' => $customer['image'],
            'logged_in' => true
        ];

        session()->set($sessionData); // Simpan session

        // Debug: Periksa apakah session berhasil tersimpan
        // dd(session()->get());

        return redirect()->to(base_url('/'))->with('success','Anda Berhasil Login 😁');
    }
}
