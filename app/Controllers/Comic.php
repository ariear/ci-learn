<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comic extends BaseController
{
    public function index()
    {
        $comicModel = new ComicModel();
        $comic = $comicModel->findAll();

        return view('pages/comic',[
            'title' => 'Comic',
            'comics' => $comic
        ]);
    }
}
