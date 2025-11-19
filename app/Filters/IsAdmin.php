<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Periksa apakah pengguna sudah login
        if (! session('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // 2. Periksa apakah role pengguna adalah 'admin'
        if (session('user_role') !== 'admin') {
            return redirect()->to(base_url())->with('error', 'Akses ditolak. Hanya Admin yang diizinkan.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang dilakukan setelah
    }
}