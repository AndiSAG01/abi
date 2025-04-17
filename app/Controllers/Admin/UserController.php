<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;

class UserController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function index()
    {
        $cutomer = new UserModel();
        $data  = [
            'customer' => $cutomer->where('role','customer')->find(),
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy')
        ];
        // return view('admins/customer/index',$data);
        return $this->blade->render('admins.customer.index', $data);
    }
}
