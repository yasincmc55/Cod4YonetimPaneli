<?php
namespace App\Models;
use CodeIgniter\Model;;

class UserModel extends Model{
   protected $table = 'users';
   private $key = 'id';
   protected $allowedFields = ['id','username','email','password','user_group_id','token','status'];

   public function get_users(){
      return $this->select('users.*, user_groups.name')
                  ->join('user_groups','user_groups.id=users.user_group_id')
                  ->findAll();
   }

    public function getUserPermissions($userId)
    {
        return $this->db->table('user_group_permissions')
            ->select('permissions.per_key')
            ->join('permissions', 'permissions.id = user_group_permissions.permission_id')
            ->join('user_groups', 'user_groups.id = user_group_permissions.user_group_id')
            ->join('users', 'users.user_group_id = user_groups.id')
            ->where('users.id', $userId)
            ->get()
            ->getResultArray();
    }


}