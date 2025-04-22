<?php

namespace Myth\Auth\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;

class LoginFilter extends BaseFilter implements FilterInterface
{
    /**
     * Verifies that a user is logged in, or redirects to login.
     *
     * @param array|null $arguments
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sedang mengakses route Myth:Auth, jika iya biarkan
        foreach ($this->reservedRoutes as $reservedRoute) {
            if (url_is(route_to($reservedRoute))) {
                return;
            }
        }

        // Cek apakah user belum login
        if (!$this->authenticate->check()) {
            session()->set('redirect_url', current_url());
            return redirect($this->reservedRoutes['login']);
        }

        // Ambil user yang sedang login
        $auth = service('authentication');
        $user = $auth->user();
        $uri = current_url(true)->getSegment(1); // Ambil segment pertama

        // Daftar segment yang diizinkan untuk admin
        $adminAllowedURIs = ['admins', 'transaction-admin', 'Laporan', 'check-payment', 'confirmation', 'end','cancel'];

        // Aturan akses berdasarkan role
        if ($user->role === 'admin') {
            $allowed = false;
            foreach ($adminAllowedURIs as $allowedUri) {
                if (str_starts_with($uri, $allowedUri)) {
                    $allowed = true;
                    break;
                }
            }

            if (!$allowed) {
                return redirect()->to('/admins-index')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        } elseif ($user->role === 'customer') {
            if (str_starts_with($uri, 'admins') || str_starts_with($uri, 'transaction-admin') || str_starts_with($uri, 'Laporan')) {
                return redirect()->to('/')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa di sini
    }
}
