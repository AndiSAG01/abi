<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterController extends BaseController
{
    protected $model;
    protected $blade;

    public function __construct()
    {
        $this->model = new Customer();
        $this->blade = new BladeOneLibrary();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Register | Seri Tutorial CodeIgniter 4: Login dan Register @ qadrlabs.com'
        ];

        // return view('customers/auth/register', $data);
        return $this->blade->render('customers.auth.register', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $costumerModel = new Customer();
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[customers.email]',
            'password' => 'required|min_length[8]',
            'telphone' => 'required|numeric',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error','Data Tidak Valid');
        }

        $image = $this->request->getfile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/customers', $imageName);

        $costumerModel->insert([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'telphone' => $this->request->getVar('telphone'),
            'image' => $imageName,
        ]);

        return redirect()->to(base_url('logins'))->with('success','Registrasi Berhasil 😁');
        
    }
}
