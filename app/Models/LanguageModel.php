<?php
namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model{
    protected $table = 'language';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'code'
    ];

}