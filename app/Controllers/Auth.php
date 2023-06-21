<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        redirect()->to(site_url('login'));
    }

    public function login()
    {
        if(session('id_user')){                                 // patokan biar gk bisa kembali ke login dengan sembarang adalah session
            return redirect()->to(site_url('home'));
        }
        return view('auth/login');
    }

    public function loginProccess(){
        $post = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['email_user' => $post['email']]);
        $user = $query->getRow();

        if($user){
            if(password_verify($post['password'], $user->password_user)){           //password user = field dari database
                $params = ['id_user' => $user -> id_user];                          // 'id_user' = index baru
                session()->set($params);
                return redirect()->to(site_url('home'));
            }else{
                return redirect()->back()-> with('error', 'Password Tidak sesuai');
            }

        }else{
            return redirect()->back()-> with('error', 'Email Tidak Ditemukan');     //back = biar kembali ke halaman yg sekarang/sebelumnya
        }
    }

    public function logout(){
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }

}