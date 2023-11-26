<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member_model;
use App\Models\Group_model;
use App\Models\Kirim_email_model;


class Member extends Controller
{

    public function create()
    {
        $memberModel = new Member_model();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'id_group' => $this->request->getPost('id_group'),
                'nama_member' => $this->request->getPost('nama_member'),
                'alamat_member' => $this->request->getPost('alamat_member'),
                'email_member' => $this->request->getPost('email_member'),
                'telp_member' => $this->request->getPost('telp_member'),
                'password_member' => $this->request->getPost('password_member')
            ];
            $memberModel->createMember($data);

            return redirect()->to('member/create')->with('success', 'Member created successfully');
        }

        $data['groups'] = (new Group_model())->findAll();

        return view('member/create', $data);
    }

    public function edit_member($id_member)
    {
        $memberModel = new \App\Models\MemberModel();
        $member = $memberModel->find($id_member);

        if (!$member) {
            // Jika data member tidak ditemukan, Anda bisa menangani kasus ini sesuai kebutuhan aplikasi Anda
            return redirect()->to('/member/list')->with('error', 'Data member tidak ditemukan.');
        }

        // Pastikan data yang akan diedit adalah milik member yang telah login
        if ($member['id_user'] !== session()->get('id_user')) {
            // Jika bukan milik member yang telah login, Anda bisa menangani kasus ini sesuai kebutuhan aplikasi Anda
            return redirect()->to('/member/list')->with('error', 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        $data = [
            'member' => $member
        ];

        return view('member/edit_member', $data);
    }

    public function update_member()
    {
        $id_member = $this->request->getPost('id_member');

        // Pastikan data yang akan diupdate adalah milik member yang telah login
        $memberModel = new \App\Models\MemberModel();
        $member = $memberModel->find($id_member);

        if (!$member || $member['id_user'] !== session()->get('id_user')) {
            // Jika bukan milik member yang telah login, Anda bisa menangani kasus ini sesuai kebutuhan aplikasi Anda
            return redirect()->to('/member/list')->with('error', 'Anda tidak memiliki izin untuk mengupdate data ini.');
        }

        // Lakukan update data di sini

        return redirect()->to('/member/list')->with('success', 'Data member berhasil diupdate.');
    }

    public function delete($id)
    {
        $memberModel = new Member_model();
        $memberModel->deleteMember($id);

        return redirect()->to('/member')->with('success', 'Member deleted successfully');
    }
}
