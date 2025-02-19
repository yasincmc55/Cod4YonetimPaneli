<?php

namespace App\Models;
use CodeIgniter\Model;

class UserGroupModel extends Model {
    protected $table = 'user_groups';
    protected $allowedFields = ['name'];
}
