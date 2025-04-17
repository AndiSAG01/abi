<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Cart;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{

    protected $cartsModel;

    public function __construct()
    {
        $this->cartsModel = new Cart();
    }

    public function add_list()
    {
        
        $cartModel = new Cart(); // Pastikan kamu punya model Cart

        $userId = session()->get('logged_in');
        $tourId = $this->request->getPost('tour_id');

        // Cek apakah user login
        if (!$userId) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu');
        }
        // dd(session()->get());
        

        $data = [
            'user_id' => $userId,
            'tour_id' => $tourId, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($cartModel->insert($data)) {
            return redirect()->to('/transaction')->with('success', 'Tour berhasil ditambahkan ke daftar');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan tour');
        }
    }


    public function delete_list($id)
    {
        $transactionModel = new Cart();

        if ($transactionModel->delete(['id' => $id])) {
            return redirect()->to('/transaction')->with('success', 'Tour deleted from list successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete tour');
        }
    }
}
