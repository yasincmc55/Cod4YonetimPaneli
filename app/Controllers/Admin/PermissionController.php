<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserGroupModel;
use App\Models\PermissionModel;
use App\Models\UserGroupPermissionModel;

class PermissionController extends BaseController
{
    public function index()
    {
        $groupModel = new UserGroupModel();
        $permissionModel = new PermissionModel();
        $groupPermissionModel = new UserGroupPermissionModel();

        $groups = $groupModel->findAll();
        $permissions = $permissionModel->findAll();

        // Gruplara ait mevcut yetkileri çek
        $groupPermissions = [];
        foreach ($groupPermissionModel->findAll() as $gp) {
            $groupPermissions[$gp['user_group_id']][] = $gp['permission_id'];
        }

        return view('admin/templates/head') .
            view('admin/templates/header') .
            view('admin/templates/sidebar') .
            view('admin/user-group-permissions', [
                'groups' => $groups,
                'permissions' => $permissions,
                'groupPermissions' => $groupPermissions,
            ]) .
            view('admin/templates/footer');
    }

    public function userSavePermissions()
    {
        $groupPermissionModel = new UserGroupPermissionModel();
        $userModel = new UserModel();


        $permissionsData = $this->request->getPost('permissions');


        $groupPermissionModel->truncate();


        foreach ($permissionsData as $groupId => $permissionIds) {
            foreach ($permissionIds as $permissionId) {
                $groupPermissionModel->insert([
                    'user_group_id' => $groupId,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        $userId = session()->get('user_id');
        if ($userId) {
            $userPermissions = $userModel->getUserPermissions($userId);
            $permissionArray = array_column($userPermissions, 'per_key');

            session()->set('user_permissions', $permissionArray);
        }

        session()->setFlashdata('success', 'Yetkiler başarıyla kaydedildi');
        return redirect()->to('/admin/user-permissions');
    }


    public function permissionList()
    {
        permissionCheck('user_grub_management_list');

        $per = new PermissionModel();
        $permissions = $per->findAll();
        $data['permissions'] = $permissions;

        return
        view('admin/templates/head').
        view('admin/templates/header').
        view('admin/templates/sidebar').
        view('admin/permissions', $data).
        view('admin/templates/footer');
    }

    public function store()
    {
        permissionCheck('permission_store');
        $per = new PermissionModel();

        $per_name = $this->request->getPost('per_name');
        $per_key = $this->request->getPost('per_key');
        $status = $this->request->getPost('status');

        $data = [
            'name' => $per_name,
            'per_key' => $per_key,
            'status' => $status,
        ];

        if ($per->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Yetki Eklendi',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Yetki eklenirken bir hata oluştu',
            ]);
        }
    }

    public function get_single()
    {
        $id = $this->request->getPost('id');

        $per = new PermissionModel();
        $result = $per->find($id);

        // Veri bulunduysa JSON olarak dön
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
        $per_name = $this->request->getPost('per_name');
        $per_key = $this->request->getPost('per_key');
        $status = $this->request->getPost('status');

        $per = new PermissionModel();
        $updateData = [
            'name' => $per_name,
            'per_key' => $per_key,
            'status' => $status,
        ];

        $result = $per->update($id, $updateData);

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
        $permissionModel = new PermissionModel();

        if ($permissionModel->find($id)) {
            $permissionModel->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'İzin başarıyla silindi.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'İzin bulunamadı.',
            ]);
        }
    }
}
