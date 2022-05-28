<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Kompetensi
{
    protected $_db;
    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['nip'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['kompetensi'] = $this->_db->other_query("SELECT * FROM t_kompetensi", 2);
        view('layouts/_head');
        view('kompetensi/index', $data);
        view('layouts/_foot');
    }

    public function tambah_kompetensi()
    {
        $kode_terakhir = $this->_db->get_last_param('t_kompetensi', 'kode_kompetensi');
        if ($kode_terakhir) {
            $nilai_kode = substr($kode_terakhir['kode_kompetensi'], 2);
            $kode = (int) $nilai_kode;
            $kode = $kode + 1;
            $kode_otomatis = "KP" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "KP01";
        }
        $data['kode_otomatis'] = $kode_otomatis;
        view('layouts/_head');
        view('kompetensi/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_kompetensi()
    {
        $input = post();
        $kode_kompetensi = $input['kode_kompetensi'];
        $kompetensi = $input['kompetensi'];
        $created_by = $_SESSION['nip'];
        // insert t_kompetensi
        $insert = $this->_db->insert("
            INSERT INTO t_kompetensi (kode_kompetensi, kompetensi, created_by)
            VALUES ('$kode_kompetensi', '$kompetensi', '$created_by')");

        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Data Kompetensi berhasil ditambahkan";
            $res['page'] = "Kompetensi";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Kompetensi gagal ditambahkan";
        }

        echo json_encode($res);
    }
    public function ubah_kompetensi($kode)
    {
        $data['kompetensi'] = $this->_db->other_query("SELECT * FROM t_kompetensi WHERE kode_kompetensi = '$kode'");
        view('layouts/_head');
        view('kompetensi/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_kompetensi()
    {
        $input         = post();
        $kode_kompetensi = $input['kode_kompetensi'];
        $kompetensi = $input['kompetensi'];

        // update t_kompetensi
        $update = $this->_db->edit("
            UPDATE t_kompetensi SET kompetensi = '$kompetensi'
            WHERE kode_kompetensi = '$kode_kompetensi'");

        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data kompetensi berhasil diubah";
            $res['page'] = "kompetensi";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal diubah";
        }

        echo json_encode($res);
    }
    public function hapus_kompetensi()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('t_kompetensi', 'kode_kompetensi', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "kompetensi";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
