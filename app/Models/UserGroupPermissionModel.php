<?php
namespace App\Models;
use CodeIgniter\Model;

class UserGroupPermissionModel extends Model {
    protected $table = 'user_group_permissions';
    protected $allowedFields = ['user_group_id', 'permission_id'];
}
