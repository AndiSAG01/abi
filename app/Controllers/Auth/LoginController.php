<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Users();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('/admins-index'));
        }

        $data = [
            'title' => 'Login | Seri Tutorial CodeIgniter 4: Login dan Register @ qadrlabs.com'
        ];

        return view('auth/login', $data);
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

        $credentials = ['email' => $email];

        $user = $this->model->where($credentials)
            ->first();

        if (! $user) {
            return redirect()->back()->with('error','Email dan Password Anda Salah!');
        }

        $passwordCheck = password_verify($password, $user['password']);

        if (! $passwordCheck) {
            return redirect()->back()->with('error','Password Anda Salah!');
        }

        $userData = [
            'name' => $user['name'],
            'email' => $user['email'],
            'logged_in' => TRUE
        ];

        session()->set($userData);
        return redirect()->to(base_url('/admins-index'))->with('success', 'Anda Berhasil Login');
    }

}
