<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class UserController extends BaseController
{
    public function index()
    {
        $cutomer = new Customer();
        $data  = [
            'customer' => $cutomer->findAll(),
            'user_name' => session()->get('name'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy')
        ];
        return view('admins/customer/index',$data);
    }
}
