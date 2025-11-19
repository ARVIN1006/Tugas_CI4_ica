<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url', 'session']); // Pastikan helper session dimuat
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
        ];

        if ($this->request->is('post')) {
            $rules = [
                'name'      => 'required|min_length[3]|max_length[255]',
                'email'     => 'required|valid_email|is_unique[users.email]|max_length[255]',
                'password'  => 'required|min_length[6]',
                'confirmpassword' => 'matches[password]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $userData = [
                    'name'     => $this->request->getPost('name'),
                    'email'    => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'role'     => 'user',
                ];

                $this->userModel->insert($userData);
                
                return redirect()->to(base_url('login'))->with('success', 'Registrasi berhasil. Silakan login.');
            }
        }
        
        return view('register', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];

        if ($this->request->is('post')) {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email    = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                
                $user = $this->userModel->where('email', $email)->first();

                if ($user && password_verify($password, $user['password'])) {
                    $sessionData = [
                        'user_id'    => $user['id'],
                        'user_name'  => $user['name'],
                        'user_email' => $user['email'],
                        'user_role'  => $user['role'],
                        'isLoggedIn' => true,
                    ];
                    // PERBAIKAN: Menggunakan helper session()
                    session()->set($sessionData);
                    
                    if ($user['role'] === 'admin') {
                        return redirect()->to(base_url('admin/news'))->with('success', 'Login Admin berhasil!');
                    }
                    
                    return redirect()->to(base_url())->with('success', 'Login berhasil!');
                    
                } else {
                    $data['error'] = 'Email atau Kata Sandi salah.';
                }
            }
        }

        return view('login', $data);
    }

    public function logout()
    {
        // PERBAIKAN: Menggunakan helper session()
        session()->destroy();
        
        return redirect()->to(base_url('login'))->with('success', 'Anda telah logout.');
    }
}