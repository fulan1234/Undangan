<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Gawe extends BaseController
{

    public function index()
    {
        // Working With Databases » Generating Query Results ( dokumentasi ci 4)
        
        //cara 1
        // $builder = $this->db->table('gawe');
        // $query   = $builder->get()->getResult();  // Produces: SELECT * FROM mytable

        //cara 2
        $query = $this->db->query("select * from gawe");
        $data['gawe'] = $query->getResult();
        return view('gawe/get', $data);
    }

    public function create(){
        return view('gawe/add');
    }

    public function store(){
        $validate = $this->validate([
            'name_gawe' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Username harus Diisi :).',
                    'min_length' => 'Baris lu kurang panjang, minimal 3'
                ],
            ],
            'date_gawe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ISI SUU'
                ],
            ]
        ]);
        if(!$validate){
            return redirect()->back()->withInput();
        }

        //cara 1 syarat: name harus sama antara database dengan yg di form
        $data = $this->request->getPost();

        //cara 2 lebih spesifik, kek di praktikum
        // $data = [
        //     'name_gawe' => $this->request->getVar('name_gawe'),
        //     'date_gawe' => $this->request->getVar('date_gawe'),
        //     'info_gawe' => $this->request->getVar('info_gawe')
        // ];

        $this->db->table('gawe')->insert($data);

        if($this->db->affectedRows() > 0){
            return redirect()->to(site_url('gawe'))->with('success', 'Data Berhasil Disimpan');     //sucess = nama data | data ber.... = isi pesannya
        }
    }

    public function edit($id = null){
        if($id != null){
            $query = $this->db->table('gawe')->getWhere(['id_gawe'=> $id]);
            // print_r($query);
            if($query->resultID->num_rows > 0 ){
                $data['gawe'] = $query->getRow();
                return view('gawe/edit',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id){
        // cara 1
        // $data = $this->request->getPost();
        // unset($data['_method']);        // buat nyambungin name input hidden biar bisa di update

        // cara 2
        $data = [
            'name_gawe' => $this->request->getVar('name_gawe'),
            'date_gawe' => $this->request->getVar('date_gawe'),
            'info_gawe' => $this->request->getVar('info_gawe')
        ];

        $this->db->table('gawe')->Where(['id_gawe' => $id])->update($data);
        return redirect()->to(site_url('gawe'))->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id){
        $this->db->table('gawe')->where(['id_gawe' => $id])->delete();
        return redirect()->to(site_url('gawe'))->with('success','Data Berhasil Dihapus');
    }

}
