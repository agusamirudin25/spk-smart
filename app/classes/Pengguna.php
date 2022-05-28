<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Pengguna
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
        $data['pengguna'] = $this->_db->other_query("SELECT t_pengguna.nip, t_pengguna.nama_lengkap, t_pengguna.jabatan, t_role.role FROM t_pengguna JOIN t_role ON t_pengguna.role = t_role.id", 2);
        view('layouts/_head');
        view('pengguna/index', $data);
        view('layouts/_foot');
    }

    public function tambah_pengguna()
    {
        $data['role'] = $this->_db->other_query('SELECT id, `role` FROM t_role', 2);
        view('layouts/_head');
        view('pengguna/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_pengguna()
    {
        $input = post();
        $nip            = $input['nip'];
        $nama_lengkap   = $input['nama_lengkap'];
        $jabatan        = $input['jabatan'];
        $role           = $input['role'];
        $password       = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_nip = $this->_db->get("SELECT nip FROM t_pengguna WHERE nip = '$nip'");

        if ($validasi_nip == NULL) {
            $insert = $this->_db->insert("INSERT INTO t_pengguna(nip, nama_lengkap, `password`, `role`, jabatan) values ('$nip', '$nama_lengkap', '$password', '$role', '$jabatan')");
            if ($insert) {
                $res['status'] = 1;
                $res['msg'] = "Data Pengguna berhasil ditambahkan";
                $res['page'] = "Pengguna";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data Pengguna gagal ditambahkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal ditambahkan. NIP sudah digunakan";
        }

        echo json_encode($res);
    }
    public function ubah_pengguna($nip)
    {
        $data['role'] = $this->_db->other_query('SELECT id, `role` FROM t_role', 2);
        $data['pengguna'] = $this->_db->other_query("SELECT * FROM t_pengguna WHERE nip = '$nip'");
        view('layouts/_head');
        view('pengguna/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_pengguna()
    {
        $input          = post();
        $nip            = $input['nip'];
        $nama_lengkap   = $input['nama_lengkap'];
        $jabatan        = $input['jabatan'];
        $role           = $input['role'];
        $password       = $input['password'];
        $password_hash  = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_nip = $this->_db->get("SELECT nip FROM t_pengguna WHERE nip = '$nip' AND nip != '$nip'");
        if($validasi_nip == NULL){
            if ($password == NULL || $password == '') {
                $update = $this->_db->edit("UPDATE t_pengguna SET nama_lengkap = '$nama_lengkap', `role` = '$role', jabatan = '$jabatan' WHERE nip = '$nip'");
            } else {
                $update = $this->_db->edit("UPDATE t_pengguna SET nama_lengkap = '$nama_lengkap', `role` = '$role', jabatan = '$jabatan', `password` = '$password_hash' WHERE nip = '$nip'");
            }
            if ($update) {
                $res['status'] = 1;
                $res['msg'] = "Data berhasil diubah";
                $res['page'] = "Pengguna";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data gagal diubah";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal diubah. NIP sudah digunakan";
        }
        echo json_encode($res);
    }
    public function hapus_pengguna()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('t_pengguna', 'nip', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "Pengguna";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
