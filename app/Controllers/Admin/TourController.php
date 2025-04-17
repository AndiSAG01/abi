<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Tour;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class TourController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function index()
    {
        $tourModel = new Tour();
        $data['tours'] = $tourModel->getTours();
        $data['user_name'] = session()->get('username'); // Ambil nama dari session
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        // return view('admins/tour/index', $data);
        // Menggunakan BladeOneLibrary
        return $this->blade->render('admins.tour.index', $data);
    }

    public function create()
    {
        $classificationModel = new Classification(); // Model sudah disesuaikan
        $categoryModel = new Category(); // Pastikan nama model sesuai

        $data = [
            'classifications' => $classificationModel->findAll(),
            'categories' => $categoryModel->findAll(),
        ];
        $data['user_name'] = session()->get('username');
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');

        // Menggunakan BladeOneLibrary
        return $this->blade->render('admins.tour.create', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $tourModel = new Tour();

        $validation = $this->validate([
            'name' => 'required',
            'classification' => 'required',
            'category' => 'required',
            'location' => 'required',
            'ticket' => 'required|numeric',
            'information' => 'required',
            'information_detail' => 'required',
            'status' => 'required|in_list[aktif,nonaktif]', // Validasi status
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        // Upload gambar
        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/tours', $imageName);

        $tourModel->insert([
            'name' => $this->request->getPost('name'),
            'classification' => implode(',', $this->request->getPost('classification')),
            'category' => implode(',', $this->request->getPost('category')),
            'location' => $this->request->getPost('location'),
            'ticket' => $this->request->getPost('ticket'),
            'information' => $this->request->getPost('information'),
            'information_detail' => $this->request->getPost('information_detail'),
            'status' => $this->request->getPost('status'), // Menyimpan status
            'image' => $imageName
        ]);

        return redirect()->to('/admins/tour')->with('success', 'Tour berhasil ditambahkan!');
    }

    public function show($id)
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

        if (!$data['tour']) {
            return redirect()->to('/admins/tour')->with('error', 'Tour tidak ditemukan!');
        }

        $data['user_name'] = session()->get('username');
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');

        // return view('admins/tour/show', $data);
        // Menggunakan BladeOneLibrary
        return $this->blade->render('admins.tour.show', $data);
    }

    public function edit($id)
    {
        $tourModel = new Tour();
        $classificationModel = new Classification();
        $categoryModel = new Category();

        $tour = $tourModel->select('tour.*')
            ->where('tour.id', $id)
            ->first();

        if (!$tour) {
            return redirect()->to('/admins/tour')->with('error', 'Tour tidak ditemukan!');
        }

        // Pisahkan data klasifikasi & kategori menjadi array
        $tourClassifications = explode(',', $tour['classification'] ?? '');
        $tourCategories = explode(',', $tour['category'] ?? '');

        $data = [
            'tour' => $tour,
            'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, YYYY'),
            'classifications' => $classificationModel->findAll(),
            'categories' => $categoryModel->findAll(),
            'tourClassifications' => $tourClassifications, // Tambahkan variabel ini
            'tourCategories' => $tourCategories // Tambahkan variabel ini
        ];

        // return view('admins/tour/edit', $data);
        // Menggunakan BladeOneLibrary
        return $this->blade->render('admins.tour.edit', $data);
    }


    public function update($id)
    {
        helper(['form', 'url']);

        $tourModel = new Tour();

        $validation = $this->validate([
            'name' => 'required',
            'classification' => 'required',
            'category' => 'required',
            'location' => 'required',
            'ticket' => 'required|numeric',
            'information' => 'required',
            'information_detail' => 'required',
            'status' => 'required|in_list[aktif,nonaktif]', // Validasi status
            'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        // Ambil data lama
        $tour = $tourModel->find($id);
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour tidak ditemukan!');
        }

        $image = $this->request->getFile('image');
        $imageName = $tour['image']; // Gunakan gambar lama jika tidak ada yang baru

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/tours', $imageName);

            // Hapus gambar lama jika ada
            if (!empty($tour['image']) && file_exists('uploads/tours/' . $tour['image'])) {
                unlink('uploads/tours/' . $tour['image']);
            }
        }

        // Update data
        $tourModel->update($id, [
            'name' => $this->request->getPost('name'),
            'classification' => implode(',', $this->request->getPost('classification')),
            'category' => implode(',', $this->request->getPost('category')),
            'location' => $this->request->getPost('location'),
            'ticket' => $this->request->getPost('ticket'),
            'information' => $this->request->getPost('information'),
            'information_detail' => $this->request->getPost('information_detail'),
            'status' => $this->request->getPost('status'), // Menyimpan status
            'image' => $imageName
        ]);

        return redirect()->to('/admins/tour')->with('success', 'Tour berhasil diperbarui!');
    }


    public function delete($id)
    {
        $tourModel = new Tour();
        $tour = $tourModel->find($id);

        if (!$tour) {
            return redirect()->to('/admins/tour')->with('error', 'Tour tidak ditemukan!');
        }

        // Hapus gambar terkait
        if (file_exists('uploads/tours/' . $tour['image'])) {
            unlink('uploads/tours/' . $tour['image']);
        }

        $tourModel->delete($id);
        return redirect()->to('/admins/tour')->with('success', 'Tour berhasil dihapus!');
    }
}
