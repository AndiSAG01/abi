<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Item;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class ItemController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Item();
    }
    public function index()
    {
        $data = [
            'items' => $this->model->findAll(),
            'user_name' => session()->get('name'),
            'today' => Time::now('Asia/Jakarta','en')->toLocalizedString('MMM d, YYYY'),
        ];
        return view('admins/item/index', $data);
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => ['required','min_length[3]', 'is_unique[items.name]'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ]);

        if (!$validate) {
            return redirect()->back()->with('error','Data Tidak Valid');
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
           'stock' => $this->request->getVar('stock'),
        ];
        $this->model->insert($data);
        return redirect()->to('/admins/item')->with('success','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Item not found');
        }

        $data = [
            'item' => $item,
            'user_name' => session()->get('name'),
            'today' => Time::now('Asia/Jakarta','en')->toLocalizedString('MMM d, YYYY'),
        ];
        return view('admins/item/edit', $data);
    }

    public function update($id)
    {
        $validate = $this->validate([
            'name' => ['required','min_length[3]'],
            'price' => ['required', 'numeric'],
           'stock' => ['required', 'numeric'],
        ]);

        if (!$validate) {
            return redirect()->back()->with('error','Data Tidak Valid');
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
           'stock' => $this->request->getVar('stock'),
        ];

        $this->model->update($id, $data);
        return redirect()->to('/admins/item')->with('success','Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Item not found');
        }

        $this->model->delete($id);
        return redirect()->to('/admins/item')->with('success','Data Berhasil Dihapus');
    }
}
