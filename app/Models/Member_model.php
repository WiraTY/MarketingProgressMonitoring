<?php

namespace App\Models;

use CodeIgniter\Model;

class Member_model extends Model
{
    protected $table = 'tb_member';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['id_group', 'nama_member', 'alamat_member', 'email_member', 'telp_member', 'password_member'];

    public function group()
    {
        return $this->belongsTo(Group_model::class, 'id_group');
    }

    public function getMembersWithKirimEmail()
    {
        return $this->join('tb_kirim_email', 'tb_kirim_email.id_member = tb_member.id_member', 'left')
            ->findAll();
    }

    public function getMemberById($id_member)
    {
        return $this->where('id_member', $id_member)->first();
    }

    public function getProgressByMemberId($id_member)
    {
        // Query untuk mengambil data progress berdasarkan id_member
        $query = $this->db->table('tb_member')
            ->join('tb_kirim_email', 'tb_member.id_member = tb_kirim_email.id_member')
            ->where('tb_member.id_member', $id_member)
            ->orderBy('tb_kirim_email.id_kirim_email', 'DESC')
            ->get();

        return $query->getResultArray();
    }

    public function getProgressByMemberGroup($id_group)
    {
        // Query untuk mengambil data progress berdasarkan id_member
        $query = $this->db->table('tb_member')
            ->join('tb_kirim_email', 'tb_member.id_member = tb_kirim_email.id_member')
            ->where('tb_member.id_group', $id_group)
            ->select('tb_member.id_member, tb_member.nama_member, COUNT(tb_kirim_email.id_member) AS kirim_emails_count', false)
            ->groupBy('tb_member.id_member, tb_member.nama_member')
            ->get();

        return $query->getResultArray();
    }

    public function getMemberEmails()
    {
        $query = $this->db->table('tb_member')
            ->join('tb_kirim_email', 'tb_member.id_member = tb_kirim_email.id_member', 'left')
            ->select('tb_member.id_member, tb_member.nama_member, COUNT(tb_kirim_email.id_member) AS kirim_emails_count', false)
            ->groupBy('tb_member.id_member, tb_member.nama_member')
            ->get();

        return $query->getResult();
    }

    public function getPassword($id_member)
    {
        $query = $this->select('password_member')
            ->where('id_member', $id_member)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->password_member;
        } else {
            return null;
        }
    }

    public function updatePassword($id_member, $new_password)
    {
        // Hash password baru sebelum menyimpannya
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $data = [
            'password_member' => $hashed_password,
        ];

        $this->update($id_member, $data);

        return true; // Berhasil mengubah password
    }

    public function createMember($data)
    {
        return $this->insert($data);
    }

    public function updateMember($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMember($id)
    {
        return $this->delete($id);
    }
}
