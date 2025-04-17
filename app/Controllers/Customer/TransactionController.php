<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;
use Myth\Auth\Models\UserModel;


class TransactionController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    public function index()
    {

        $transactionModel = new Transaction();
        $customerModel = new UserModel();
        $itemModel = new Item();

        $userId = session()->get('logged_in');
        $customer = $customerModel->where('id', $userId)->first();

        // Ambil data transaksi dan cart dari model
        // $transactions = $transactionModel->getTransactionsByCustomer($userId);
        $carts = $transactionModel->getCartByCustomer($userId);
        // Hitung total harga tiket dalam cart
        $totalTicketPrice = 0;
        foreach ($carts as $cart) {
            $totalTicketPrice += (int) ($cart['tour_ticket'] ?? 0);
        }

        $data = [
            // 'transactions' => $transactions,
            'items' => $itemModel->findAll(),
            'customers' => $customer,
            'cart' => $carts,
            'totalTicketPrice' => $totalTicketPrice, // Kirim totalTicketPrice ke tampilan
        ];

        // return view('customers.transaction.index', $data);
        return $this->blade->render('customers.transaction.index', $data);
    }



    public function store()
    {
        // if (!$this->isLoggedIn()) {
        //     return redirect()->to('/login');
        // }

        $transactionModel = new Transaction();
        $itemModel = new Item();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'total_people' => 'required|integer|greater_than[0]',
            'start_date'   => 'required|valid_date[Y-m-d]',
            'end_date'     => 'required|valid_date[Y-m-d]|validateDateRange[start_date,end_date]',
        ], [
            'end_date' => [
                'validateDateRange' => 'Tanggal Kepulangan tidak boleh lebih kecil dari tanggal Keberangkatan.',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $userId = session()->get('logged_in');

        // Ambil semua data cart berdasarkan customer_id
        $cartData = $transactionModel->getCartByCustomer($userId);

        if (empty($cartData)) {
            return redirect()->back()->with('error', 'Data cart tidak ditemukan.');
        }

        // Ambil cart_id dan total harga tiket
        $cartIds = [];
        $totalTicketPrice = 0;
        foreach ($cartData as $cart) {
            $cartIds[] = $cart['id'];
            $totalTicketPrice += (int) ($cart['tour_ticket'] ?? 0);
        }
        $cartIdString = implode(',', $cartIds);

        // Ambil data item_id dan qty dari form
        $itemIds = $this->request->getPost('item_id') ?? [];
        $quantities = $this->request->getPost('qty') ?? [];

        if (!is_array($itemIds) || !is_array($quantities)) {
            return redirect()->back()->with('error', 'Kesalahan input. Mohon ulangi.');
        }

        // Persiapkan data item dan validasi stok
        $itemsWithQty = [];
        $totalItemPrice = 0;

        foreach ($itemIds as $key => $itemId) {
            $qty = isset($quantities[$key]) ? (int) $quantities[$key] : 0;
            if ($qty > 0) {
                $itemsWithQty[$itemId] = $qty;
            }
        }

        // Cek stok tersedia
        if (!empty($itemsWithQty)) {
            $items = $itemModel->whereIn('id', array_keys($itemsWithQty))->findAll();

            foreach ($items as $item) {
                if ($itemsWithQty[$item['id']] > $item['stock']) {
                    return redirect()->back()->with('error', "Stok tidak cukup untuk item: {$item['name']}.");
                }
                $totalItemPrice += ((int) ($item['price'] ?? 0)) * $itemsWithQty[$item['id']];
            }
        }

        // Hitung total amount
        $totalPeople = (int) ($this->request->getPost('total_people') ?? 1);
        $amount = ($totalTicketPrice * $totalPeople) + $totalItemPrice;

        // Ambil start_date dan end_date dari form
        $startDate = $this->request->getPost('start_date');
        $endDate   = $this->request->getPost('end_date');

        // Cek apakah start_date dan end_date sudah ada di database
        $existingTransaction = $transactionModel
            ->where('start_date', $startDate)
            ->where('end_date', $endDate)
            ->first();

        if ($existingTransaction) {
            return redirect()->back()->with('error', 'Tanggal yang dipilih sudah ada.');
        }

        // Simpan data transaksi dalam transaksi database
        $db = \Config\Database::connect();
        $db->transStart();

        $transactionData = [
            'user_id'  => $userId,
            'cart_id'      => $cartIdString,
            'item_id'      => !empty($itemsWithQty) ? implode(',', array_keys($itemsWithQty)) : null,
            'qty'          => !empty($itemsWithQty) ? implode(',', array_map('intval', array_values($itemsWithQty))) : '0',
            'amount'       => $amount,
            'start_date'   => $startDate,
            'end_date'     => $endDate,
            'total_people' => $totalPeople,
            'status'       => 'Pending'
        ];

        $transactionModel->insert($transactionData);

        // Update stok item setelah transaksi berhasil
        foreach ($itemsWithQty as $itemId => $qty) {
            $itemModel->where('id', $itemId)->decrement('stock', $qty);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menambahkan transaksi.');
        }

        return redirect()->to('/transactions-table')->with('success', 'Transaksi berhasil ditambahkan dan stok diperbarui.');
    }


    public function getBookingDates()
    {
        $transactionModel = new Transaction();
        $transactions = $transactionModel->select('start_date, end_date')->findAll();

        return $this->response->setJSON($transactions);
    }


    function table()
    {
        // if (!$this->isLoggedIn()) {
        //     return redirect()->to('/login');
        // }

        $transactionModel = new Transaction();
        $customerModel = new UserModel();
        $userId = session()->get('logged_in');
        $customer = $customerModel->where('id', $userId)->first();
        $transactions = $transactionModel->getTransactionsByCustomer($userId);

        $data = [
            'transactions' => $transactions
        ];
        return $this->blade->render('customers.transaction.table', $data);
    }

    public function payment($id)
    {
        $transactionModel = new Transaction();
        $bankModel = new Bank();

        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            return redirect()->to('/transactions-table')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Cek apakah sudah ada pembayaran untuk transaksi ini
        $paymentModel = new Payment();
        $existingPayment = $paymentModel->where('transaction_id', $id)->first();

        if ($existingPayment) {
            return redirect()->to('/transactions-table')->with('error', 'Pembayaran untuk transaksi ini sudah dikirim.');
        }

        $data = [
            'transaction' => $transaction,
            'bank' => $bankModel->findAll(),
        ];

        return $this->blade->render('customers.transaction.payment', $data);
    }

    public function payment_store()
    {
        $paymentModel = new Payment();
        $transactionModel = new Transaction();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'transaction_id'   => 'required|is_unique[payments.transaction_id]',
            'image'            => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads/payments/', $newName);
        } else {
            return redirect()->back()->withInput()->with('error', ['image' => 'Gagal mengunggah gambar.']);
        }

        $paymentData = [
            'transaction_id' => $this->request->getPost('transaction_id'),
            'payment_date'   => Carbon::now()->toDateTimeString(),
            'image'          => $newName,
        ];

        $paymentModel->insert($paymentData);

        // Update status transaksi menjadi "Menunggu Konfirmasi"
        $transactionModel->update($this->request->getPost('transaction_id'), [
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect()->to('/transactions-table')->with('success', 'Pembayaran berhasil dikirim.');
    }
}
