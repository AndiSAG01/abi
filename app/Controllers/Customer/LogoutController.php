<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LogoutController extends BaseController
{
    public function index()
    {

        $userData = [
            'name',
            'email',
            'logged_in'
        ];

        session()->remove($userData);

        return redirect()->to(base_url('logins'));

    }
}
