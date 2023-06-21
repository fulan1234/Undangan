<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\GroupModel;

class Groups extends ResourcePresenter
{
    //cara 1 helper
    // public function __construct()
    // {
    //     helper('custom');        
    // }

    // cara 2 helper
    protected $helpers = ['custom'];           // fyi helper ditaro disini karena controller Groups ini nggak extend dari BaseController, melainkan ResourcePresenter, jadinya helper dari baseController nggak terbaca


    // function __construct()
    // {
    //     $this->group = new GroupModel();
    // }
    // bisa juga pake dibawah ini
    protected $modelName = 'App\Models\GroupModel';

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        // $data['groups'] = $this->group->findAll();   // bUAT YG CONSTRUCT
        $data['groups'] = $this->model->findAll();
        return view('groups/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        return view('groups/new');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $validate = $this->validate([
            'name_group' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Lu Harus Ganti Username Bre.',
                    'min_length' => 'Baris lu kurang panjang, minimal 3'
                ],
            ],
            'info_group' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'ISI SUU',
                    'min_length' => 'Baris lu kurang panjang, minimal 3'
                ],
            ]
        ]);
        if(!$validate){
            return redirect()->back()->withInput();
        }

        $data = $this->request->getPost();      // hirauin aja, udh bisa kok
        $this->model->insert($data);
        return redirect()->to(site_url('groups'))->with('success', 'Data Berhasil Disimpan');
        
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $group= $this->model->where('id_group', $id)->first();
        if(is_object($group)){
            $data['group'] = $group;
            return view('groups/edit', $data);
        }else{
            throw \codeigniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $validate = $this->validate([
            'name_group' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Lu Harus Ganti Username Bre.',
                    'min_length' => 'Baris lu kurang panjang, minimal 3'
                ],
            ],
            'info_group' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'ISI SUU',
                    'min_length' => 'Baris lu kurang panjang, minimal 3'
                ],
            ]
        ]);
        if(!$validate){
            return redirect()->back()->withInput();
        }
        $data = $this->request->getPost();      // hirauin aja, udh bisa kok
        $this->model->update($id,$data);
        return redirect()->to(site_url('groups'))->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        // cara 1
        // $this->model->where('id_group',$id)->delete();
        
        // cara 2
        $this->model->delete($id);
        
        return redirect()->to('groups')->with('success', 'Data Berhasil Disimpan');
    }

    public function trash(){
        $data['groups'] = $this->model->onlyDeleted()->findAll();
        return view('groups/trash', $data);
    }

    public function restore($id = null){            // Bisa Dengan any ataupun tidak, tentu itu pasti berbeda
        if($id != null){
            // $this->model->update($id, ['deleted_at' => null]);
            $this->db      = \Config\Database::connect();
            $this->db->table('groups')
            ->set('deleted_at',null, true)
            ->where(['id_group' => $id])
            ->update();
            if($this->db->affectedRows() > 0 ){
                return redirect()->to(site_url('groups'))->with('success','Data Berhasil Di restore');
            }
        }else{
            $this->db      = \Config\Database::connect();
            $this->db->table('groups')
            ->set('deleted_at',null, true)
            ->where('deleted_at is NOT NULL', NULL , FALSE)
            ->update();
            if($this->db->affectedRows() > 0 ){
                return redirect()->to(site_url('groups'))->with('success','Data Berhasil Di restore');
            }
        }
    }
}
