<?php
if (!function_exists('permissionCheck')) {
    function permissionCheck($permissionKey)
    {
        $permissions = session()->get('user_permissions') ?? [];

        if (!in_array($permissionKey, $permissions)) {
            session()->setFlashdata('permission_error', 'İşlem yetkiniz yok');
            header('Location: ' . base_url('admin'));
            exit;
        }
    }
}

