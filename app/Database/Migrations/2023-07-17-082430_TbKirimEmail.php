<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKirimEmail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kirim_email INT PRIMARY KEY AUTO_INCREMENT',
            'tgl_kirim_email DATE',
            'id_member INT',
            'nama_perusahaan VARCHAR(255)',
            'negara_perusahaan VARCHAR(255)',
            'status_terkirim ENUM("terkirim", "gagal")',
            'progress TEXT',
        ]);

        // Relasi dengan tabel tb_member
        $this->forge->addForeignKey('id_member', 'tb_member', 'id_member');

        $this->forge->createTable('tb_kirim_email');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kirim_email');
    }
}
