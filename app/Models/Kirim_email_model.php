<?php

namespace App\Models;

use CodeIgniter\Model;

class Kirim_email_model extends Model
{
    protected $table = 'tb_kirim_email';
    protected $primaryKey = 'id_kirim_email';
    protected $allowedFields = ['tgl_kirim_email', 'id_member', 'nama_perusahaan', 'negara_perusahaan', 'status_terkirim', 'progress'];

    public function getLaporan()
    {
        $query = $this->select('nama_member, DATE_FORMAT(tgl_kirim_email, "%e") as day, COUNT(*) as jumlah')
            ->join('tb_member', 'tb_member.id_member = tb_kirim_email.id_member')
            ->groupBy('nama_member, day')
            ->orderBy('nama_member, day')
            ->findAll();

        $laporan = [];
        foreach ($query as $row) {
            $laporan[$row['nama_member']]['nama_member'] = $row['nama_member'];
            $laporan[$row['nama_member']]['tgl_' . $row['day']] = $row['jumlah'];
        }

        return $laporan;
    }

    // public function getLaporanByBulanTahunGroup($bulan, $tahun, $id_group)
    // {
    //     $builder = $this->db->table('tb_kirim_email');
    //     $builder->select('nama_member, DATE_FORMAT(tgl_kirim_email, "%e") as day, COUNT(*) as jumlah', false);
    //     $builder->join('tb_member', 'tb_member.id_member = tb_kirim_email.id_member');
    //     $builder->join('tb_group', 'tb_group.id_group = tb_member.id_group');
    //     if (!empty($bulan) && $bulan !== "all") {
    //         $builder->where('MONTH(tgl_kirim_email)', $bulan);
    //     }

    //     if (!empty($tahun) && $tahun !== "all") {
    //         $builder->where('YEAR(tgl_kirim_email)', $tahun);
    //     }

    //     if (!empty($id_group && $id_group !== "all")) {
    //         $builder->where('tb_member.id_group', $id_group);
    //     }
    //     $builder->groupBy('nama_member, day');
    //     $builder->orderBy('nama_member, day');

    //     $query = $builder->get();

    //     $laporan = [];
    //     foreach ($query->getResultArray() as $row) {
    //         $laporan[$row['nama_member']]['nama_member'] = $row['nama_member'];
    //         $laporan[$row['nama_member']]['tgl_' . $row['day']] = $row['jumlah'];
    //     }

    //     return $laporan;
    // }
    public function getLaporanByBulanTahunGroup($bulan, $tahun, $id_group)
    {
        $builder = $this->db->table('tb_kirim_email');
        $builder->select('nama_member, DATE_FORMAT(tgl_kirim_email, "%e") as day, COUNT(*) as jumlah', false);
        $builder->join('tb_member', 'tb_member.id_member = tb_kirim_email.id_member');
        $builder->join('tb_group', 'tb_group.id_group = tb_member.id_group');
        if (!empty($bulan) && $bulan !== "all") {
            $builder->where('MONTH(tgl_kirim_email)', $bulan);
        }

        if (!empty($tahun) && $tahun !== "all") {
            $builder->where('YEAR(tgl_kirim_email)', $tahun);
        }

        if (!empty($id_group && $id_group !== "all")) {
            $builder->where('tb_member.id_group', $id_group);
        }
        $builder->groupBy('nama_member, day');
        $builder->orderBy('nama_member, day');

        $query = $builder->get();

        $laporan = [];
        foreach ($query->getResultArray() as $row) {
            $laporan[$row['nama_member']]['nama_member'] = $row['nama_member'];
            $laporan[$row['nama_member']]['tgl_' . $row['day']] = $row['jumlah'];
        }

        return $laporan;
    }

    public function getTotalNegara($id_group)
    {
        $query = $this->db->table('tb_kirim_email')
            ->select('tb_kirim_email.negara_perusahaan, COUNT(tb_kirim_email.negara_perusahaan) AS total_negara', false)
            ->join('tb_member', 'tb_member.id_member = tb_kirim_email.id_member')
            ->where('tb_member.id_group', $id_group)
            ->groupBy('tb_kirim_email.negara_perusahaan')
            ->get();

        return $query->getResult();
    }
}
