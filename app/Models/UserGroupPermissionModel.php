<?php
namespace App\Models;
use CodeIgniter\Model;

class UserGroupPermissionModel extends Model {
    protected $table = 'user_group_permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_group_id', 'permission_id'];

    public function checkPermission($userGroupId, $route)
    {
        return $this->db->table('user_group_permissions')
                ->join('permissions', 'permissions.id = user_group_permissions.permission_id')
                ->where('user_group_permissions.user_group_id', $userGroupId) // ✅ Doğru alan
                ->where('permissions.per_key', $route)
                ->countAllResults() > 0;
    }

}
