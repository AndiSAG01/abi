<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\Bank;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class BankController extends BaseController
{
    protected $bankModel;
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
        $this->bankModel = new Bank();
    }

    public function index()
    {
        $data = [
           'bank' => $this->bankModel->findAll(),
           'user_name' => session()->get('username'),
            'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
        ];
        return $this->blade->render('admins.bank.index',$data);
    }

    public function store()
    {
        $validationRules = [
            'name'           => 'required',
            'account_number' => 'required',
            'image'          => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/banks/', $imageName);
        }

        $this->bankModel->save([
            'name'           => $this->request->getPost('name'),
            'account_number' => $this->request->getPost('account_number'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/admins/bank')->with('success', 'Data Berhasiil Ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'bank' => $this->bankModel->find($id),
            'user_name' => session()->get('username'),
             'today' => Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy'),
         ];
        if (!$data['bank']) {
            return redirect()->to('/admins/bank')->with('error', 'Bank not found.');
        }

        return $this->blade->render('admins.bank.edit',$data);
    }

    public function update($id)
    {
        $bank = $this->bankModel->find($id);
        if (!$bank) {
            return redirect()->to('/admins/bank')->with('error', 'Bank not found.');
        }

        $validationRules = [
            'name'           => 'required',
            'account_number' => 'required',
            'image'          => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = $bank['image']; // default: existing image

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image
            if ($bank['image'] && file_exists('uploads/banks/' . $bank['image'])) {
                unlink('uploads/banks/' . $bank['image']);
            }

            // Save new image
            $imageName = $image->getRandomName();
            $image->move('uploads/banks/', $imageName);
        }

        $this->bankModel->update($id, [
            'name'           => $this->request->getPost('name'),
            'account_number' => $this->request->getPost('account_number'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/admins/bank')->with('success', 'Data Berhasil Di update');
    }

    public function delete($id)
    {
        $bank = $this->bankModel->find($id);
        if ($bank && $bank['image']) {
            $imagePath = 'uploads/banks/' . $bank['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->bankModel->delete($id);
        return redirect()->to('/admins/bank')->with('success', 'Data Berhasil Dihapus');
    }
}
