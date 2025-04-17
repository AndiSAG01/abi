<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Customer;
use App\Models\Tour;
use App\Models\Transaction;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;

class AdminController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function pages()
    {
        $tourModel = new Tour();
        $customerModel = new UserModel();
        $transactionModel = new Transaction();

        $totalCustomers = $customerModel->where('role','customer')->countAllResults();
        $totalTours = $tourModel->countAll();
        $totalTransactions = $transactionModel->where('status', 'Selesai')->countAllResults();

        // Ambil data transaksi selesai per bulan
        $transactionsPerMonth = $transactionModel
            ->select("MONTH(created_at) as month, COUNT(*) as count")
            ->where('status', 'Selesai')
            ->groupBy("MONTH(created_at)")
            ->orderBy("month", "ASC")
            ->findAll();

        $months = [];
        $counts = [];

        foreach ($transactionsPerMonth as $row) {
            $months[] = date("F", mktime(0, 0, 0, $row['month'], 1));
            $counts[] = $row['count'];
        }

        $data = [
            'transaction' => $totalTransactions,
            'customer' => $totalCustomers,
            'tour' => $totalTours,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
            'months' => json_encode($months),
            'counts' => json_encode($counts)
        ];

        return $this->blade->render('admins.dashboard', $data);
    }


    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }
}
