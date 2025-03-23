<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Classification;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Config\Services;

class ClassificationController extends BaseController
{
    protected $classificationModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->classificationModel = new Classification();
    }

    public function index()
    {
        $pager = Services::pager();

        $data = [
            'classifications' => $this->classificationModel->paginate(5, 'classifications'),
            'pager' => $this->classificationModel->pager
        ];
        $data['user_name'] = session()->get('name'); // Ambil nama dari session
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        return view('admins/classification/index', $data);
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => [
                'rules' => 'required|is_unique[classifications.name]',
                'errors' => [
                    'required' => 'Nama Klasifikasi harus diisi',
                    'is_unique' => 'Nama Klasifikasi sudah ada'
                ]
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput()->with('error', 'Data yang kamu masukkan tidak valid');
        }

        $this->classificationModel->save([
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to(base_url('admins/klasifikasi'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data['classification'] = $this->classificationModel->find($id);
        $data['user_name'] = session()->get('name'); // Ambil nama dari session
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        return view('admins/classification/edit', $data);
    }

    public function update($id)
    {
        $validate = $this->validate([
            'name' => [
                'rules' => 'required|is_unique[classifications.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama klasifikasi harus diisi',
                    'is_unique' => 'Nama klasifikasi sudah ada'
                ]
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid');
        }

        $this->classificationModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to(base_url('admins/klasifikasi'))->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete($id)
    {
        if ($this->classificationModel->find($id)) {
            $this->classificationModel->delete($id);
            return redirect()->to(base_url('admins/klasifikasi'))->with('success', 'Data Berhasil Dihapus');
        }

        return redirect()->to(base_url('admins/klasifikasi'))->with('error', 'klasifikasi tidak ditemukan');
    }
}
