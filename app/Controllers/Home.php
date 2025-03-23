<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Tour;

class Home extends BaseController
{
    public function index()
    {
        $tourModel = new Tour(); // Pastikan nama model sesuai
        $customerModel = new Customer(); // Pastikan nama model sesuai

        // Ambil data customer yang sedang login (contoh: berdasarkan session)
        $customerId = session()->get('customer_id'); // Sesuaikan dengan key session yang Anda gunakan
        $customer = $customerModel->find($customerId); // Ambil data customer berdasarkan ID

        $data = [
            'title' => 'Home Page',
            'tour' => $tourModel->findAll(),
            'customer' => $customer // Kirim data customer ke view
        ];

        return view('customers/dashboard', $data);
    }

    public function about()
    {
        return view('customers/about', ['title' => 'About Page']);
    }
    public function destination()
    {
        // if (! $this->isLoggedIn()) {
        //     return redirect()->to('/logins');
        // }

        $tourModel = new Tour(); // Pastikan nama model sesuai
        $data = [
            'title' => 'Home Page',
            'tours' => $tourModel->findAll()
        ];
        return view('customers/destination', $data);
    }
    public function destination_detail($id)
    {
        $tourModel = new Tour();

        // Ambil detail tour dengan nama klasifikasi dan kategori
        $data['tour'] = $tourModel->select('tour.*, 
            GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names, 
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->where('tour.id', $id)
            ->groupBy('tour.id')
            ->first();

        return view('customers/destination_detail', $data);
    }
    public function admin()
    {
        return view('layouts/admin', ['title' => 'Destination Page']);
    }

    public function pages()
    {
        return view('layouts/admin');
    }

    public function booking($id)
    {
        if (! $this->isLoggedIn()) {
            return redirect()->to('/logins');
        }

        $tourModel = new Tour();
        $data = [
            'title' => 'Booking Page',
            'tour' => $tourModel->find($id)
        ];
        return view('customers/booking', $data);
    }

    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }
}
