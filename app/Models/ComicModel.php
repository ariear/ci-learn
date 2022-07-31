<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicModel extends Model
{
    protected $table = 'comic';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis' , 'penerbit' , 'sampul'];

    public function getComic($slug = false){
        if ($slug == false) {
            return $this->findAll();
        }
        
        return $this->where('slug', $slug)->first();
    }
}