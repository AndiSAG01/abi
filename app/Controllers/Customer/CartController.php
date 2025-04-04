<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Cart;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    protected $cartsModel;

    public function __construct()
    {
        $this->cartsModel = new Cart();
    }

    public function add_list()
    {
        $transactionModel = new Cart();

        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'tour_id' => $this->request->getPost('tour_id'),
            'amount' => null, // Tambahkan ini biar field amount dikosongkan
        ];

        if ($transactionModel->insert($data)) {
            return redirect()->to('/transaction')->with('success', 'Tour added to list successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add tour');
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
