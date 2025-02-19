<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserGroupModel;

class UserGroupController extends BaseController{
    public function index(){
        $userGroupModel = new UserGroupModel();
        $uGroups = $userGroupModel->findAll();
        return view('admin/templates/head').
            view('admin/templates/header').
            view('admin/templates/sidebar').
            view('admin/user_groups',['ugroups'=>$uGroups]).
            view('admin/templates/footer');
    }

    public function store()
    {
        $group_name = $this->request->getPost('group_name');
        $status = $this->request->getPost('status');

        $ug = new UserGroupModel();
        $data = [
            'name' => $group_name,
            'status' => $status,
        ];

        if ($ug->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kullanıcı Gurubu Eklendi',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Kullanıcı gurubu eklenirken hata oluştu',
            ]);
        }
    }


    public function get_single()
    {
        $id = $this->request->getPost('id');

        $ug = new UserGroupModel();
        $result = $ug->find($id);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'İzin kaydı bulunamadı.',
            ]);
        }
    }


    public function update()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $status = $this->request->getPost('status');

        $ug = new UserGroupModel();
        $updateData = [
            'name' => $name,
            'status' => $status,
        ];

        $result = $ug->update($id, $updateData);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Güncelleme Başarılı',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Güncelleme Başarısız',
            ]);
        }
    }


    public function delete()
    {
        $id = $this->request->getPost('id');
        $ug = new UserGroupModel();

        if ($ug->find($id)) {
            $ug->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kullanıcı gurubu başarıyla silindi.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Hata.',
            ]);
        }
    }




}
