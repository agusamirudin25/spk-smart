<?php

namespace App\Classes;

header('Access-Control-Allow-Origin:*');

class Auth
{
    private $auth;

    public function __construct()
    {
        $this->auth = new Database();
    }

    public function index()
    {
        if (isset($_SESSION['nip'])) {
            redirect('Dashboard');
        }
        $title = 'Sistem Pendukung Keputusan Menentukan Ekstrakurikuler Siswa';
        return view('login', compact('title'));
    }

    public function cek_login()
    {
        $input = post($_POST);
        $kode_pengguna = $input['kode_pengguna'];
        $password = $input['password'];
        $user = $this->auth->get("SELECT * from pengguna WHERE kode_pengguna = '$kode_pengguna'");
        if ($user) {
            if ($user->status != '1') {
                $data['msg'] = 'NIS/NIP atau password tidak ditemukan !';
                $data['title'] = 'Login Failed ';
                $data['status'] = 0;
            } else {
                if (password_verify($password, $user->password)) :
                    $nipPengguna = $user->kode_pengguna;
                    $nama = $user->nama_lengkap;
                    $type = $user->role;
                    
                    $data['title'] = 'Login Success';
                    $data['msg'] = 'Data ditemukan';
                    $data['status'] = 1;
                    if($type == 1){
                        $data['page'] = 'Dashboard';
                    }else{
                        $data['page'] = 'Penilaian';
                    }
                    session_set('nip', $nipPengguna);
                    session_set('nama', $nama);
                    session_set('type', $type);
                else :
                    $data['msg'] = 'NIS/NIP atau password tidak ditemukan !';
                    $data['title'] = 'Login Failed ';
                    $data['status'] = 0;
                endif;
            }
        } else {
            $data['msg'] = 'NIS/NIP atau password tidak ditemukan !';
            $data['title'] = 'Login Failed ';
            $data['status'] = 0;
        }

        echo json_encode($data);
    }
    public function logout()
    {
        session_del('nip');
        session_del('nama');
        session_del('type');
        session_destroy();
        redirect('Auth');
    }
}
