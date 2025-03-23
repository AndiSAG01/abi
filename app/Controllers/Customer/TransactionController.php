<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Tour;
use App\Models\Transaction;
use CodeIgniter\HTTP\ResponseInterface;

class TransactionController extends BaseController
{
    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    protected $transactionsModel;

    public function __construct()
    {
        $this->transactionsModel = new Transaction();
    }
    public function index()
    {
        if (! $this->isLoggedIn()) {
            return redirect()->to('/logins');
        }

        $item = new Item();
        $transaction = new Transaction();
        $customer = new Customer();
        $userId = session()->get('customer_id');
        $customers = $customer->where('id', $userId)->first();


        $data = [
            'transactions' => $transaction->getAllTransactions(),
            'items' => $item->findAll(),
            'customers' => $customers,
        ];
        return view('customers/transaction/index', $data);
    }

    public function add_list()
    {
        $transactionModel = new Transaction();

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
        $transactionModel = new Transaction();

        if ($transactionModel->delete(['id' => $id])) {
            return redirect()->to('/transaction')->with('success', 'Tour deleted from list successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete tour');
        }
    }

    public function updateTransaction($id)
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        // Aturan validasi
        $validation->setRules([
            'item_id'       => 'required',
            'total_people'  => 'required|numeric',
            'start_date'    => 'required|valid_date',
            'end_date'      => 'required|valid_date',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil nilai dari request
        $itemIds = $request->getPost('item_id');
        if (!is_array($itemIds)) {
            return redirect()->back()->withInput()->with('errors', ['item_id' => 'Pilih minimal satu item.']);
        }

        // Konversi array item_id menjadi string (contoh: "1,2,3")
        $itemIdsString = implode(',', $itemIds);

        // Ambil transaksi berdasarkan ID
        $transactionModel = new Transaction();
        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Data yang akan diperbarui
        $transactionData = [
            'item_id'       => $itemIdsString,
            'total_people'  => $request->getPost('total_people'),
            'start_date'    => $request->getPost('start_date'),
            'end_date'      => $request->getPost('end_date'),
            'status'        => 'Sedang Menunggu Pembayaran',
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Lakukan update transaksi
        $transactionModel->update($id, $transactionData);

        return redirect()->to('/transactions-table')->with('success', 'Transaksi berhasil diperbarui!');
    }







    public function table()
    {
        $transactionModel = new Transaction();
        $transactions = $transactionModel->findAll();

        $data = [
            'transactions' => $transactions
        ];

        return view('customers/transaction/table', $data);
    }
}
