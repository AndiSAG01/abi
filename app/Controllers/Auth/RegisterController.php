<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Users();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Register | Seri Tutorial CodeIgniter 4: Login dan Register @ qadrlabs.com'
        ];

        return view('auth/register', $data);
    }
    public function store()
    {
        $data = $this->request->getPost(['name', 'email', 'password']);

        if (! $this->validateData($data, $this->model->validationRules)) {
            return $this->index();
        }

        $user = $this->validator->getValidated();

        $save = $this->model->save($user);

        if ($save) {
            session()->setFlashdata('success', 'Register Berhasil!');
            return redirect()->to(base_url('login'));
        } else {
            session()->setFlashdata('error', $this->model->errors());
            return redirect()->back();
        }
    }
}
