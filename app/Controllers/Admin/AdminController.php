<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class AdminController extends BaseController
{
    public function pages()
    {
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login!');
        }

        $data['user_name'] = session()->get('name'); // Ambil nama dari session
        $data['today'] = Time::now('Asia/Jakarta', 'en')->toLocalizedString('MMM d, yyyy');
        return view('admins/dashboard', $data);
    }


    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }
}
