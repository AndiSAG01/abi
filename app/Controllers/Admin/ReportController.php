<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Libraries\Pdfgenerator;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Users;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;
use Dompdf\Options;
use Myth\Auth\Models\UserModel;

class ReportController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function customer()
    {
        $cutomer = new UserModel();
        $data  = [
            'customer' => $cutomer->where('role', 'customer')->findAll(),
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy')
        ];

        return $this->blade->render('admins.customer.report', $data);
    }


    public function customerPdf()
    {
        $customerModel = new Users();
        $dompdf = new Dompdf();

        $data = [
            'title_pdf' => 'Laporan Data Customer',
            'customer' => $customerModel->where('role','customer')->findAll(),
            'user_name' => session()->get('nameusername'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];

        $html = $this->blade->render('admins.customer.pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan Data Customer.pdf', array(
            "Attachment" => false
        ));
    }

    public function transaction()
    {
        $transactionModel = new Transaction();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

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
            ->where('transactions.status', 'Selesai');

        if ($startDate && $endDate) {
            $transactions->where('transactions.start_date >=', $startDate)
                ->where('transactions.end_date <=', $endDate);
        }

        $transactions = $transactions
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();

        $data = [
            'transactions' => $transactions,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return $this->blade->render('admins.transaction.report', $data);
    }

    public function TransactionPdf()
    {
        $transactionModel = new Transaction();
        $dompdf = new Dompdf();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Query dasar
        $transactionModel = $transactionModel
            ->select('transactions.*, 
            users.username AS username, 
            tour.name AS tour_name, 
            tour.location AS tour_location, 
            tour.ticket AS tour_ticket,
            tour.image AS tour_image,
            GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
            GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names')
            ->join('carts', 'carts.id = transactions.cart_id', 'left')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')
            ->where('transactions.status', 'Selesai');

        // Filter tanggal jika tersedia
        if ($startDate && $endDate) {
            $transactionModel = $transactionModel
                ->where('transactions.start_date >=', $startDate)
                ->where('transactions.end_date <=', $endDate);
        }

        // Group by agar GROUP_CONCAT tidak duplikat
        $transactionModel = $transactionModel->groupBy('transactions.id');

        $data = [
            'title_pdf' => 'Laporan Data Transaksi',
            'transactions' => $transactionModel->findAll(),
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        // Render view menjadi HTML
        $html = $this->blade->render('admins.transaction.pdf', $data);


        // Load dan generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Outputkan ke browser
        $dompdf->stream('Laporan Data Transaksi.pdf', array(
            "Attachment" => false
        ));
    }
}
