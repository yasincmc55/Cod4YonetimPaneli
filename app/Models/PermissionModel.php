<?php
namespace App\Models;
use CodeIgniter\Model;

class PermissionModel extends Model {
    protected $table = 'permissions';
    protected $allowedFields = ['name', 'per_key'];
}
