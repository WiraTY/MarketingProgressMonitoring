<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member_model;
use App\Models\Kirim_email_model;
use CodeIgniter\HTTP\Request;

class Progress extends Controller
{
    public function index()
    {
        $memberModel = new Member_model();
        $id_member = session()->get('user_id');
        $members = $memberModel->getProgressByMemberId($id_member);
        $data = [
            'title' => 'Daftar Progress',
            'members' => $members,
        ];

        return view('progress/index', $data);
    }

    public function tambah()
    {

        $memberModel = new Member_model();
        $members = $memberModel->findAll();
        $data = [
            'title' => 'Tambah Progress',
            'members' => $members,
        ];

        return view('progress/tambah', $data);
    }

    public function prosses_tambah()
    {
        $request = service('request');


        $validationRules = [
            'tgl_kirim_email' => 'required|valid_date',
            'id_member' => 'required',
            'nama_perusahaan' => 'required|max_length[100]',
            'negara_perusahaan' => 'required',
            'status_terkirim' => 'required|in_list[Terkirim,Gagal]',
        ];

        $validationMessages = [
            'tgl_kirim_email' => [
                'required' => 'Tanggal Kirim Email harus diisi.',
                'valid_date' => 'Tanggal Kirim Email tidak valid.',
            ],
            'id_member' => [
                'required' => 'ID Member harus diisi.',
            ],
            'nama_perusahaan' => [
                'required' => 'Nama Perusahaan harus diisi.',
                'max_length' => 'Nama Perusahaan maksimal 100 karakter.',
            ],
            'negara_perusahaan' => [
                'required' => 'Negara Perusahaan harus diisi.',
            ],
            'status_terkirim' => [
                'required' => 'Status Terkirim harus diisi.',
                'in_list' => 'Status Terkirim harus berupa "Terkirim" atau "Gagal".',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            // Jika validasi gagal, kembali ke halaman kirim.php dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tgl_kirim_email = $request->getPost('tgl_kirim_email');
        $id_member = $request->getPost('id_member');
        $nama_perusahaan = $request->getPost('nama_perusahaan');
        $negara_perusahaan = $request->getPost('negara_perusahaan');
        $status_terkirim = $request->getPost('status_terkirim');
        $progress = "<ol> <li>Mengirim email pada Tanggal " . $tgl_kirim_email . "</li></ol>";

        // Data kirim email yang akan disimpan
        $dataKirimEmail = [
            'tgl_kirim_email' => $tgl_kirim_email,
            'id_member' => $id_member,
            'nama_perusahaan' => $nama_perusahaan,
            'negara_perusahaan' => $negara_perusahaan,
            'status_terkirim' => $status_terkirim,
            'progress' => $progress,
        ];

        // Simpan data kirim email ke dalam tabel tb_kirim_email
        $kirimEmailModel = new Kirim_email_model();
        $kirimEmailModel->insert($dataKirimEmail);

        return redirect()->to(base_url('progress/daftar'))->with('success', 'Data progress berhasil ditambahkan');
    }

    public function edit($id_kirim_email)
    {
        $kirimEmailModel = new Kirim_email_model();
        // $data['kirim_email'] = $kirimEmailModel->find($id_kirim_email);
        $kirim_email = $kirimEmailModel->find($id_kirim_email);

        $memberModel = new \App\Models\Member_model();
        $nama_members = $memberModel->findAll();

        $data = [
            'title' => 'Edit Progress',
            'kirim_email' => $kirim_email,
            'nama_members' => $nama_members,
        ];

        if (!$data['kirim_email']) {
            return redirect()->to(base_url('member/index'))->with('error', 'Data progress tidak ditemukan.');
        }

        return view('progress/edit', $data);
    }

    public function proses_edit($id_kirim_email)
    {
        $request = service('request');

        // Validasi data (sama seperti pada simpan_kirim_email)
        $validationRules = [
            'tgl_kirim_email' => 'required|valid_date',
            'nama_member' => 'required',
            'nama_perusahaan' => 'required|min_length[2]|max_length[100]',
            'negara_perusahaan' => 'required|min_length[3]|max_length[50]',
            'status_terkirim' => 'required|in_list[Terkirim,Gagal]',
        ];

        $validationMessages = [
            'tgl_kirim_email' => [
                'required' => 'Tanggal Kirim Email harus diisi.',
                'valid_date' => 'Tanggal Kirim Email tidak valid.',
            ],
            'nama_member' => [
                'required' => 'Nama Member harus diisi.',
            ],
            'nama_perusahaan' => [
                'required' => 'Nama Perusahaan harus diisi.',
                'min_length' => 'Nama Perusahaan minimal 2 karakter.',
                'max_length' => 'Nama Perusahaan maksimal 100 karakter.',
            ],
            'negara_perusahaan' => [
                'required' => 'Negara Perusahaan harus diisi.',
                'min_length' => 'Negara Perusahaan minimal 3 karakter.',
                'max_length' => 'Negara Perusahaan maksimal 50 karakter.',
            ],
            'status_terkirim' => [
                'required' => 'Status Terkirim harus diisi.',
                'in_list' => 'Status Terkirim harus berupa "Terkirim" atau "Gagal".',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            // Jika validasi gagal, kembali ke halaman edit dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tgl_kirim_email = $request->getPost('tgl_kirim_email');
        $nama_member = $request->getPost('nama_member');
        $nama_perusahaan = $request->getPost('nama_perusahaan');
        $negara_perusahaan = $request->getPost('negara_perusahaan');
        $status_terkirim = $request->getPost('status_terkirim');
        $progress = $request->getPost('progress');

        // Data kirim email yang akan diupdate
        $dataKirimEmail = [
            'tgl_kirim_email' => $tgl_kirim_email,
            'nama_member' => $nama_member,
            'nama_perusahaan' => $nama_perusahaan,
            'negara_perusahaan' => $negara_perusahaan,
            'status_terkirim' => $status_terkirim,
            'progress' => $progress,
        ];

        // Simpan perubahan ke dalam tabel tb_kirim_email
        $kirimEmailModel = new Kirim_email_model();
        $kirimEmailModel->update($id_kirim_email, $dataKirimEmail);

        return redirect()->to(base_url('progress/daftar'))->with('success', 'Data progress berhasil diperbarui.');
    }

    public function delete($id)
    {
        $memberModel = new Member_model();
        $memberModel->deleteMember($id);

        return redirect()->to('/member')->with('success', 'Member deleted successfully');
    }

    function uploadGambar()
    {
        if ($this->request->getFile('file')) {
            $dataFile = $this->request->getFile('file');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("uploads/berkas/", $fileName);
            echo base_url("uploads/berkas/$fileName");
        }
    }

    function deleteGambar()
    {
        $src = $this->request->getVar('src');
        //--> uploads/berkas/1630368882_e4a62568c1b50887a8a5.png

        //https://localhost/ci4summernote/public
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
            }
        }
    }
    function listGambar()
    {
        $files = array_filter(glob('uploads/berkas/*'), 'is_file');
        $response = [];
        foreach ($files as $file) {
            if (strpos($file, "index.html")) {
                continue;
            }
            $response[] = basename($file);
        }
        header("Content-Type:application/json");
        echo json_encode($response);
        die();
    }

    // public function uploadFile()
    // {
    //     $data = [];

    //     if ($this->request->getFile('upload')) {
    //         $file = $this->request->getFile('upload');

    //         if ($file->isValid() && !$file->hasMoved()) {
    //             $allowedExtensions = ['jpg', 'jpeg', 'png'];

    //             if (in_array($file->getExtension(), $allowedExtensions)) {
    //                 $newName = $file->getRandomName();
    //                 $file->move(ROOTPATH . 'public/assets/upload/', $newName);

    //                 $data['file'] = $file->getName();
    //                 $data['url'] = base_url('public/assets/upload/' . $newName);
    //                 $data['uploaded'] = 1;
    //             } else {
    //                 $data['uploaded'] = 0;
    //                 $data['error']['message'] = 'Invalid extension';
    //             }
    //         } else {
    //             $data['uploaded'] = 0;
    //             $data['error']['message'] = 'Error! File not found';
    //         }
    //     } else {
    //         $data['uploaded'] = 0;
    //         $data['error']['message'] = 'No file uploaded';
    //     }

    //     return json_encode($data);
    // }

    public function upload(Request $request){
        $post = new Post;
        $post -> progress = $request -> progress;
        $post -> save();
        return redirect()->back();
    }
}
