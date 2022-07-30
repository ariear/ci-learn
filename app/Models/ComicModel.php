<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicModel extends Model
{
    protected $table = 'comic';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
}