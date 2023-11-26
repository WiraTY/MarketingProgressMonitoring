<?php

namespace App\Controllers;

use App\Models\Member_model;

class Login extends BaseController
{
    public function index()
    {
        $data['csrfToken'] = csrf_hash();
        // Pengecekan jika pengguna sudah login
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('member/progress/tambah')); // Ubah 'vw_home' sesuai dengan halaman yang diinginkan setelah login
        }

        // Proses login jika pengguna belum login
        return view('login/index', $data);
    }

    public function process()
    {
        $users = new Member_model();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'email_member' => $email,
        ])->first();
        if ($dataUser) {
            if ($password === $dataUser['password_member']) {
                session()->set([
                    'user_id' => $dataUser['id_member'], // Ubah 'id' menjadi 'id_member'
                    'nama_member' => $dataUser['nama_member'],
                    'id_group' => $dataUser['id_group'],
                    'email_member' => $dataUser['email_member'],
                    'alamat_member' => $dataUser['alamat_member'],
                    'telp_member' => $dataUser['telp_member'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('dashboard/index'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
