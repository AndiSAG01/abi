<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class AdmTransaction extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }

    public function index()
    {
        $transactionModel = new Transaction();

        // Ambil semua transaksi dengan status 'Menunggu Konfirmasi'
        $transactions = $transactionModel
            ->select('transactions.*, 
            users.username AS username, 
            tour.name AS tour_name, 
            tour.location AS tour_location, 
            tour.ticket AS tour_ticket,
            tour.image AS tour_image,
            GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
            GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names, 
            transactions.item_id,
            transactions.qty')
            ->join('carts', 'carts.id = transactions.cart_id', 'left')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')
            ->where('transactions.status', 'Menunggu Konfirmasi') // Ini kuncinya
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();

        $data = [
            'transactions' => $transactions,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];

        return $this->blade->render('admins.transaction.confirmation', $data);
    }



    function check_payment($id)
    {
        // $session = session();
        // $customerId = $session->get('logged_in');
        $transactionModel = new Transaction();
        $paymentModel = new Payment();

        $transaction = $transactionModel->find($id);
        $payment = $paymentModel->where('transaction_id', $id)->first();

        $data = [
            'payments' => $payment,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];
        return $this->blade->render('admins.transaction.check_payment', $data);
    }

    public function confirmation($id)
    {
        $transactionModel = new Transaction();

        // Cek apakah data transaksi dengan ID tersebut ada
        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Update status transaksi menjadi "Sedang Berjalan"
        $transactionModel->update($id, [
            'status' => 'Sedang Berjalan'
        ]);

        return redirect()->to(base_url('/transaction-admin/Sedang-Dalam-Perjalanan'))->with('success', 'Tour Sedang Menjalani perjalanan');
    }

    function otw()
    {
        $transactionModel = new Transaction();

        // Ambil semua transaksi dengan status 'Menunggu Konfirmasi'
        $transactions = $transactionModel
        ->select('transactions.*, 
        users.username AS username, 
        tour.name AS tour_name, 
        tour.location AS tour_location, 
        tour.ticket AS tour_ticket,
        tour.image AS tour_image,
        GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
        GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
        GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names, 
        transactions.item_id,
        transactions.qty')
        ->join('carts', 'carts.id = transactions.cart_id', 'left')
        ->join('users', 'users.id = transactions.user_id', 'left')
        ->join('tour', 'tour.id = carts.tour_id', 'left')
        ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
        ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
        ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')
        ->where('transactions.status', 'Sedang Berjalan') // Ini kuncinya
        ->groupBy('transactions.id')
        ->orderBy('transactions.created_at', 'DESC')
        ->findAll();

        $data = [
            'transactions' => $transactions,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];

        return $this->blade->render('admins.transaction.ontheway', $data);
    }

    public function end($id)
    {
        $transactionModel = new Transaction();

        // Cek apakah data transaksi dengan ID tersebut ada
        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Update status transaksi menjadi "Sedang Berjalan"
        $transactionModel->update($id, [
            'status' => 'Selesai'
        ]);

        return redirect()->to(base_url('/transaction-admin/Selesai'))->with('success', 'Tour Telah Selesai');
    }

    function finished()
    {
        $transactionModel = new Transaction();

        // Ambil semua transaksi dengan status 'Menunggu Konfirmasi'
        $transactions = $transactionModel
        ->select('transactions.*, 
        users.username AS username, 
        tour.name AS tour_name, 
        tour.location AS tour_location, 
        tour.ticket AS tour_ticket,
        tour.image AS tour_image,
        GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
        GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
        GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names, 
        transactions.item_id,
        transactions.qty')
        ->join('carts', 'carts.id = transactions.cart_id', 'left')
        ->join('users', 'users.id = transactions.user_id', 'left')
        ->join('tour', 'tour.id = carts.tour_id', 'left')
        ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
        ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
        ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')
        ->where('transactions.status', 'Selesai') // Ini kuncinya
        ->groupBy('transactions.id')
        ->orderBy('transactions.created_at', 'DESC')
        ->findAll();
        $data = [
            'transactions' => $transactions,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];

        return $this->blade->render('admins.transaction.end', $data);
    }

    public function cancelled($id)
    {
        $transactionModel = new Transaction();

        // Cek apakah data transaksi dengan ID tersebut ada
        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Update status transaksi menjadi "Sedang Berjalan"
        $transactionModel->update($id, [
            'status' => 'Dibatalkan'
        ]);

        return redirect()->to(base_url('/transaction-admin/Dibatalkan'))->with('success', 'Tour Telah Dibatalkan');
    }

    function canceled()
    {
        $transactionModel = new Transaction();

        // Ambil semua transaksi dengan status 'Menunggu Konfirmasi'
        $transactions = $transactionModel
        ->select('transactions.*, 
        users.username AS username, 
        tour.name AS tour_name, 
        tour.location AS tour_location, 
        tour.ticket AS tour_ticket,
        tour.image AS tour_image,
        GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
        GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
        GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names, 
        transactions.item_id,
        transactions.qty')
        ->join('carts', 'carts.id = transactions.cart_id', 'left')
        ->join('users', 'users.id = transactions.user_id', 'left')
        ->join('tour', 'tour.id = carts.tour_id', 'left')
        ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
        ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
        ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')
        ->where('transactions.status', 'Dibatalkan') // Ini kuncinya
        ->groupBy('transactions.id')
        ->orderBy('transactions.created_at', 'DESC')
        ->findAll();
        $data = [
            'transactions' => $transactions,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];

        return $this->blade->render('admins.transaction.canceled', $data);
    }
}
