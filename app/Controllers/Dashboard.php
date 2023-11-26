<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member_model;
use App\Models\Kirim_email_model;

class Dashboard extends Controller
{
    public function index()
    {
        $selectedGroup = $this->request->getGet('id_group') ?? session('id_group');

        $memberModel = new Member_model();
        $id_group = session()->get('id_group');
        $memberEmails = $memberModel->getProgressByMemberGroup($id_group);
        $members = $memberModel->where('id_group', $selectedGroup)->findAll();
        
        $kirimemailModel = new Kirim_email_model();
        $id_group = session()->get('id_group');
        $kirimEmails = $kirimemailModel->getTotalNegara($id_group);

        // Fungsi untuk mengurutkan data secara descending (dari terbesar ke terkecil) berdasarkan kirim_emails_count
        usort($memberEmails, function ($a, $b) {
            return $b['kirim_emails_count'] - $a['kirim_emails_count'];
        });

        $data = [
            'title' => 'Dashboard',
            'nama_members' => $members,
            'memberEmails' => $memberEmails,
            'kirimEmails' => $kirimEmails
        ];

        return view('dashboard/index', $data);
    }
}
