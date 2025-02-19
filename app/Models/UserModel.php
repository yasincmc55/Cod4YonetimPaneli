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


}