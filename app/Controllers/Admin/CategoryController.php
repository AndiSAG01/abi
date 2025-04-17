<?php

namespace App\Controllers\Admin;

use App\Libraries\BladeOneLibrary;
use App\Models\Category;
use CodeIgniter\Controller;
use CodeIgniter\Config\Services;
use CodeIgniter\I18n\Time;

class CategoryController extends Controller
{

    protected $categoryModel;
    protected $helpers = ['form', 'url'];
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $pager = Services::pager();

        $data = [
            'categories' => $this->categoryModel->paginate(5, 'categories'),
            'pager' => $this->categoryModel->pager,
            'user_name' => session()->get('username'),
        ];
        // Ambil nama dari session
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        // return view('admins/category/index', $data);
        return $this->blade->render('admins.category.index', $data);
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => [
                'rules' => 'required|is_unique[categories.name]',
                'errors' => [
                    'required' => 'Nama Kategori harus diisi',
                    'is_unique' => 'Nama Kategori sudah ada'
                ]
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput()->with('error', 'Data yang kamu masukkan tidak valid');
        }

        $this->categoryModel->save([
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to(base_url('admins/kategori'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->find($id);
        // Ambil nama dari session
        $data = [
            'user_name' => session()->get('username'),
        ];
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        // return view('admins/category/edit', $data);
        return $this->blade->render('admins.category.edit', $data);
    }

    public function update($id)
    {
        $validate = $this->validate([
            'name' => [
                'rules' => 'required|is_unique[categories.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama Kategori harus diisi',
                    'is_unique' => 'Nama Kategori sudah ada'
                ]
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid');
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to(base_url('admins/kategori'))->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete($id)
    {
        if ($this->categoryModel->find($id)) {
            $this->categoryModel->delete($id);
            return redirect()->to(base_url('admins/kategori'))->with('success', 'Data Berhasil Dihapus');
        }

        return redirect()->to(base_url('admins/kategori'))->with('error', 'Kategori tidak ditemukan');
    }
}
