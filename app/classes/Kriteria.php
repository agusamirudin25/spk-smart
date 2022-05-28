<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Kriteria
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
        $data['kriteria'] = $this->_db->other_query("SELECT * FROM t_kriteria", 2);
        view('layouts/_head');
        view('kriteria/index', $data);
        view('layouts/_foot');
    }

    public function tambah_kriteria()
    {
        $data['tipe'] = [
            'benefit',
            'cost',
        ];
        $kode_terakhir = $this->_db->get_last_param('t_kriteria', 'kode_kriteria');
        if ($kode_terakhir) {
            $nilai_kode = substr($kode_terakhir['kode_kriteria'], 1);
            $kode = (int) $nilai_kode;
            $kode = $kode + 1;
            $kode_otomatis = "K" . str_pad($kode, 1, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "K1";
        }
        $data['kode_otomatis'] = $kode_otomatis;
        view('layouts/_head');
        view('kriteria/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_kriteria()
    {
        $input = post();
        $kode_kriteria = $input['kode_kriteria'];
        $nama_kriteria = $input['nama_kriteria'];
        $tipe = $input['tipe'];
        $bobot = $input['bobot'];

        // insert t_kriteria
        $insert = $this->_db->insert("
            INSERT INTO t_kriteria (kode_kriteria, nama_kriteria, tipe, bobot)
            VALUES ('$kode_kriteria', '$nama_kriteria', '$tipe', '$bobot')");

        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Data Kriteria berhasil ditambahkan";
            $res['page'] = "Kriteria";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Kriteria gagal ditambahkan";
        }

        echo json_encode($res);
    }
    public function ubah_kriteria($kode)
    {
        $data['tipe'] = [
            'benefit',
            'cost',
        ];
        $data['kriteria'] = $this->_db->other_query("SELECT * FROM t_kriteria WHERE kode_kriteria = '$kode'");
        view('layouts/_head');
        view('kriteria/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_kriteria()
    {
        $input         = post();
        $kode_kriteria = $input['kode_kriteria'];
        $nama_kriteria = $input['nama_kriteria'];
        $tipe          = $input['tipe'];
        $bobot         = $input['bobot'];

        // update t_kriteria
        $update = $this->_db->edit("
            UPDATE t_kriteria SET nama_kriteria = '$nama_kriteria', tipe = '$tipe', bobot = '$bobot'
            WHERE kode_kriteria = '$kode_kriteria'");


        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data kriteria berhasil diubah";
            $res['page'] = "kriteria";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal diubah";
        }

        echo json_encode($res);
    }
    public function hapus_kriteria()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('t_kriteria', 'kode_kriteria', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "kriteria";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
