<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Tour;
use App\Models\Transaction;
use App\Models\Users;
use Carbon\Carbon;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;
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

        // Ambil cart_id dan total harga tiket hanya untuk yang dicentang
        $cartIds = $this->request->getPost('cart_id') ?? [];  // Ambil ID cart yang dipilih
        if (empty($cartIds)) {
            return redirect()->back()->with('error', 'Tidak ada cart yang dipilih.');
        }

        $totalTicketPrice = 0;
        $selectedCarts = [];

        // Filter cart data berdasarkan cart yang dipilih
        foreach ($cartData as $cart) {
            if (in_array($cart['id'], $cartIds)) {
                $selectedCarts[] = $cart;  // Menambahkan cart yang dipilih
                $totalTicketPrice += (int) ($cart['tour_ticket'] ?? 0);  // Menambahkan harga tiket dari cart yang dipilih
            }
        }

        // Cek apakah ada cart yang dipilih
        if (empty($selectedCarts)) {
            return redirect()->back()->with('error', 'Tidak ada cart yang valid yang dipilih.');
        }

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

        $cartIdString = implode(',', array_map('intval', $cartIds));  // Cart ID yang dipilih

        $transactionData = [
            'user_id'  => $userId,
            'cart_id'      => $cartIdString,
            'item_id'      => !empty($itemsWithQty) ? implode(',', array_keys($itemsWithQty)) : null,
            'qty'          => !empty($itemsWithQty) ? implode(',', array_map('intval', array_values($itemsWithQty))) : '0',
            'amount'       => $amount,
            'start_date'   => $startDate,
            'end_date'     => $endDate,
            'total_people' => $totalPeople,
            'status'       => 'Pending',
            'created_at' => Time::now()
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


    public function table()
    {
        $transactionModel = new Transaction();
        $customerModel = new UserModel();
        $cartModel = new Cart();
        $tourModel = new Tour();

        $userId = session()->get('logged_in');
        $transactions = $transactionModel->getTransactionsByCustomer($userId);

        foreach ($transactions as &$transaction) {
            $cartIds = explode(',', $transaction['cart_id']);
            $tours = [];

            foreach ($cartIds as $cartId) {
                $cart = $cartModel->find($cartId);
                if ($cart) {
                    $tour = $tourModel->find($cart['tour_id']);
                    if ($tour) {
                        $tours[] = [
                            'name'     => $tour['name'],
                            'location' => $tour['location'],
                            'image'    => $tour['image']
                        ];
                    }
                }
            }

            $transaction['tours'] = $tours;
        }

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

    public function deleteTransaction($id)
    {
        $transactionModel = new Transaction();

        $transaction = $transactionModel->find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transactionModel->delete($id);

        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
    }


    public function kwitansiPdf($id)
    {
        $transactionModel = new Transaction();
        $cartModel = new Cart();
        $tourModel = new Tour();
        $paymentModel = new Payment();
        $customerModel = new Users();
        $itemModel = new Item();

        // Ambil data transaksi
        $transaction = $transactionModel->find($id);
        if (!$transaction) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction not found');
        }

        // Buat kode transaksi jika belum ada
        $transactionCode = $this->generateTransactionCode($id, $transaction['user_id']);

        // Ambil data pembayaran
        $payment = $paymentModel->where('transaction_id', $id)->first();

        // Ambil data customer
        $customer = $customerModel->find($transaction['user_id']);
        if (!$customer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }

        // Ambil ID cart yang terkait
        $cartIds = explode(',', $transaction['cart_id']);

        // Inisialisasi data tur yang digabung
        $mergedTour = [
            'name' => '',
            'price' => 0,
            'quantity' => 0,
            'subtotal' => 0,
            'items' => []
        ];

        foreach ($cartIds as $cartId) {
            $cart = $cartModel->find($cartId);
            if ($cart) {
                $tour = $tourModel->find($cart['tour_id']);
                if ($tour) {
                    $qty = $cart['qty'] ?? 1;
                    $price = $tour['ticket'];

                    $mergedTour['name'] .= ($mergedTour['name'] ? ', ' : '') . $tour['name'];
                    $mergedTour['price'] += $price;
                    $mergedTour['quantity'] += $qty;
                    $mergedTour['subtotal'] += $price * $qty;
                }
            }
        }


        // Siapkan data untuk PDF
        $tours = [$mergedTour];
        $data = [
            'title_pdf' => 'Kwitansi Pembayaran',
            'transaction' => $transaction,
            'tours' => $tours,
            'payment' => $payment,
            'customer' => $customer,
            'transaction_code' => $transactionCode,
        ];

        // Buat dan tampilkan PDF
        $dompdf = new Dompdf();
        $html = $this->blade->render('customers.transaction.kwitansi', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('Kwitansi_Transaksi_' . $transactionCode . '.pdf', ["Attachment" => false]);
    }

    /**
     * Generate a unique transaction code based on the transaction ID and user ID
     *
     * @param int $transactionId
     * @param int $userId
     * @return string
     */
    private function generateTransactionCode($transactionId, $userId)
    {
        // Generate a unique transaction code using the transaction ID, user ID, and current timestamp
        return 'KST-' . strtoupper(substr(md5($transactionId . $userId . time()), 0, 8));  // Unique code
    }
}
