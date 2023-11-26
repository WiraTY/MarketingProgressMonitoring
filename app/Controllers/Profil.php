<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member_model;

class Profil extends Controller
{
    public function edit()
    {
        // Pengecekan jika pengguna belum login
        $id_member = session()->get('user_id');
        $memberModel = new Member_model();
        $members = $memberModel->find($id_member);
        $data = [
            'title' => 'Edit Profil',
            'members' => $members,
        ];
        return view('profil/edit', $data);
    }

    // public function proses_edit()
    // {
    //     $id_member = session()->get('user_id');

    //     // Ambil data dari form
    //     $data = [
    //         'nama_member' => $this->request->getPost('nama_member'),
    //         'email_member' => $this->request->getPost('email_member'),
    //         'alamat_member' => $this->request->getPost('alamat_member'),
    //         'telp_member' => $this->request->getPost('telp_member')
    //     ];

    //     $password_lama = $this->request->getPost('password_lama');
    //     $password_baru = $this->request->getPost('password_baru');
    //     $confirm_password = $this->request->getPost('confirm_password');

    //     // Panggil model untuk mendapatkan password_member yang ada di database
    //     $memberModel = new Member_model();
    //     $existing_password_member = $memberModel->getPassword($id_member);

    //     // Periksa apakah password lama cocok
    //     if ($existing_password_member !== null && password_verify($password_lama, $existing_password_member)) {
    //         // Periksa apakah password baru dan konfirmasi cocok
    //         if (!empty($password_baru) && $password_baru === $confirm_password) {
    //             $data['password_member'] = password_hash($password_baru, PASSWORD_DEFAULT);
    //         }
    //     } else {
    //         // Password lama tidak cocok
    //         session()->setFlashdata('error', 'Password lama salah.');
    //         return redirect()->back();
    //     }


    //     // Panggil model dan lakukan update data
    //     $memberModel = new Member_model();
    //     $memberModel->update($id_member, $data);

    //     // Set kembali data pada sesi setelah proses update berhasil
    //     session()->set([
    //         'user_id' => $id_member,
    //         'email' => $data['email_member'],
    //         'nama_member' => $data['nama_member'],
    //         'alamat_member' => $data['alamat_member'],
    //         'telp_member' => $data['telp_member'],
    //         'logged_in' => TRUE
    //     ]);

    //     // Set flashdata untuk notifikasi
    //     session()->setFlashdata('success', 'Profil berhasil diperbarui.');

    //     // Redirect kembali ke halaman edit profil
    //     return redirect()->to(base_url('profil/edit'));
    // }

    public function proses_edit()
    {
        $id_member = session()->get('user_id');
        $memberModel = new Member_model();
        $existing_member = $memberModel->find($id_member);

        if (!$existing_member) {
            session()->setFlashdata('error', 'Data member tidak ditemukan.');
            return redirect()->to(base_url('profil/edit'));
        }

        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password_baru');
        $confirm_password = $this->request->getPost('confirm_password');

        if ($password_lama === $existing_member['password_member']) {
            // Validasi password baru dan konfirmasi cocok
            if (!empty($password_baru) && $password_baru === $confirm_password) {
                $data = [
                    'nama_member' => $this->request->getPost('nama_member'),
                    'email_member' => $this->request->getPost('email_member'),
                    'alamat_member' => $this->request->getPost('alamat_member'),
                    'telp_member' => $this->request->getPost('telp_member'),
                    'password_member' => $password_baru // Simpan password baru (plaintext)
                ];

                $memberModel->update($id_member, $data);

                session()->set([
                    'nama_member' => $data['nama_member'],
                    'email_member' => $data['email_member'],
                    'alamat_member' => $data['alamat_member'],
                    'telp_member' => $data['telp_member']
                ]);

                session()->setFlashdata('success', 'Profil berhasil diperbarui.');
            } else {
                session()->setFlashdata('error', 'Password baru dan konfirmasi tidak cocok.');
            }
        } else {
            session()->setFlashdata('error', 'Password lama salah.');
        }

        return redirect()->to(base_url('profil/edit'));
    }
}
