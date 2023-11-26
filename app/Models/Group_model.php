<?php

namespace App\Models;

use CodeIgniter\Model;

class Group_model extends Model
{
    protected $table = 'tb_group';
    protected $primaryKey = 'id_group';
    protected $allowedFields = ['nama_group', 'deskripsi_group'];

    public function getGroupNames()
    {
        $query = $this->select('id_group, nama_group', 'deskripsi_group')
                      ->findAll();

        $groupNames = [];
        foreach ($query as $row) {
            $groupNames[$row['id_group']] = $row['nama_group'];
        }

        return $groupNames;
    }

    public function getGroups()
    {
        return $this->findAll();
    }

    public function getGroupById($id)
    {
        return $this->find($id);
    }

    public function createGroup($data)
    {
        return $this->insert($data);
    }
}
