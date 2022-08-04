<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    public function search($searchname = false){
        return $this->table('user')->like('name', $searchname);
    }
}