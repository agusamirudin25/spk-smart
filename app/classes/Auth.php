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
        $title = 'Sistem Pendukung Keputusan Penilaian Kinerja Guru';
        return view('login', compact('title'));
    }

    public function cek_login()
    {
        $input = post($_POST);
        $nip = $input['nip'];
        $password = $input['password'];
        $user = $this->auth->get("SELECT * from t_pengguna WHERE nip = '$nip'");
        if ($user) {
            if ($user->status != '1') {
                $data['msg'] = 'NIP atau password tidak ditemukan !';
                $data['title'] = 'Login Failed ';
                $data['status'] = 0;
            } else {
                if (password_verify($password, $user->password)) :
                    $nipPengguna = $user->nip;
                    $nama = $user->nama_lengkap;
                    $type = $user->role;
                    
                    $data['title'] = 'Login Success';
                    $data['msg'] = 'Data ditemukan';
                    $data['status'] = 1;
                    $data['page'] = 'Dashboard';
                    session_set('nip', $nipPengguna);
                    session_set('nama', $nama);
                    session_set('type', $type);
                else :
                    $data['msg'] = 'NIP atau password tidak ditemukan !';
                    $data['title'] = 'Login Failed ';
                    $data['status'] = 0;
                endif;
            }
        } else {
            $data['msg'] = 'NIP atau password tidak ditemukan !';
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
