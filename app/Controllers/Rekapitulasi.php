<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member_model;
use App\Models\Group_model;
use App\Models\Kirim_email_model;

class Rekapitulasi extends Controller
{
    // public function index()
    // {
    //     $selectedBulan = $this->request->getGet('bulan') ?? date('m'); // Nilai default bulan adalah bulan saat ini
    //     $selectedTahun = $this->request->getGet('tahun') ?? date('Y'); // Nilai default tahun adalah tahun saat ini
    //     $selectedGroup = $this->request->getGet('id_group') ?? session('id_group');

    //     $kirimEmailModel = new Kirim_email_model();
    //     // Ambil data laporan berdasarkan bulan dan tahun yang dipilih
    //     $laporan = $kirimEmailModel->getLaporanByBulanTahunGroup($selectedBulan, $selectedTahun, $selectedGroup);

    //     $memberModel = new Member_model();
    //     $nama_members = $memberModel->findAll();

    //     $groupModel = new Group_model();
    //     $groups = $groupModel->findAll();

    //     $data = [
    //         'title' => 'Rekapitulasi',
    //         'laporan' => $laporan,
    //         'nama_members' => $nama_members,
    //         'selectedBulan' => $selectedBulan,
    //         'selectedTahun' => $selectedTahun,
    //         'selectedGroup' => $selectedGroup,
    //         'groups' => $groups
    //     ];

    //     return view('rekapitulasi/index', $data);
    // }

    public function index()
    {
        $selectedBulan = $this->request->getGet('bulan') ?? date('m'); // Nilai default bulan adalah bulan saat ini
        $selectedTahun = $this->request->getGet('tahun') ?? date('Y'); // Nilai default tahun adalah tahun saat ini
        $selectedGroup = $this->request->getGet('id_group') ?? session('id_group');

        $kirimEmailModel = new Kirim_email_model();
        // Ambil data laporan berdasarkan bulan dan tahun yang dipilih
        $laporan = $kirimEmailModel->getLaporanByBulanTahunGroup($selectedBulan, $selectedTahun, $selectedGroup);

        $memberModel = new Member_model();
        $members = $memberModel->where('id_group', $selectedGroup)->findAll();

        $data = [
            'title' => 'Rekapitulasi',
            'laporan' => $laporan,
            'nama_members' => $members,
            'selectedBulan' => $selectedBulan,
            'selectedTahun' => $selectedTahun,
            'selectedGroup' => $selectedGroup,
        ];

        return view('rekapitulasi/index', $data);
    }

    public function processFilter()
    {
        // Mengambil nilai opsi filter dari form
        $selectedBulan = $this->request->getPost('bulan') ?? date('m');
        $selectedTahun = $this->request->getPost('tahun') ?? date('Y');
        $selectedGroup = $this->request->getPost('id_group') ?? session('id_group');

        // Simpan nilai opsi filter dalam sesi
        session()->set('selectedBulan', $selectedBulan);
        session()->set('selectedTahun', $selectedTahun);
        session()->set('selectedGroup', $selectedGroup);

        // Redirect kembali ke halaman yang sesuai
        return redirect()->to(base_url('rekapitulasi/index'));
    }

    public function filter()
    {
        // Memanggil fungsi processFilter untuk memproses pemilihan filter
        return $this->processFilter();
    }
}
