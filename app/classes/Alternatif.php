<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class ALternatif
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
        $data['alternatif'] = $this->_db->other_query("SELECT * FROM alternatif", 2);
        view('layouts/_head');
        view('alternatif/index', $data);
        view('layouts/_foot');
    }

    public function tambah_alternatif()
    {
        $data['tipe'] = [
            'benefit',
            'cost',
        ];
        $kode_terakhir = $this->_db->get_last_param('alternatif', 'kode_alternatif');
        if ($kode_terakhir) {
            $nilai_kode = substr($kode_terakhir['kode_alternatif'], 1);
            $kode = (int) $nilai_kode;
            $kode = $kode + 1;
            $kode_otomatis = "A" . str_pad($kode, 1, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "A1";
        }
        $data['kode_otomatis'] = $kode_otomatis;
        view('layouts/_head');
        view('alternatif/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_alternatif()
    {
        $input = post();
        $kode_alternatif = $input['kode_alternatif'];
        $nama_alternatif = $input['nama_alternatif'];
        $prestasi = $input['prestasi'];
        $waktu_latihan = $input['waktu_latihan'];

        // insert alternatif
        $insert = $this->_db->insert("
            INSERT INTO alternatif (kode_alternatif, nama_alternatif, prestasi, waktu_latihan)
            VALUES ('$kode_alternatif', '$nama_alternatif', '$prestasi', '$waktu_latihan')");

        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Data alternatif berhasil ditambahkan";
            $res['page'] = "alternatif";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data alternatif gagal ditambahkan";
        }

        echo json_encode($res);
    }
    public function ubah_alternatif($kode)
    {
        $data['alternatif'] = $this->_db->other_query("SELECT * FROM alternatif WHERE kode_alternatif = '$kode'");
        view('layouts/_head');
        view('alternatif/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_alternatif()
    {
        $input           = post();
        $kode_alternatif = $input['kode_alternatif'];
        $nama_alternatif = $input['nama_alternatif'];
        $prestasi        = $input['prestasi'];
        $waktu_latihan   = $input['waktu_latihan'];

        // update t_kriteria
        $update = $this->_db->edit("
            UPDATE alternatif SET nama_alternatif = '$nama_alternatif', prestasi = '$prestasi', waktu_latihan = '$waktu_latihan'
            WHERE kode_alternatif = '$kode_alternatif'");

        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data alternatif berhasil diubah";
            $res['page'] = "alternatif";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal diubah";
        }

        echo json_encode($res);
    }
    public function hapus_alternatif()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('alternatif', 'kode_alternatif', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "alternatif";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
