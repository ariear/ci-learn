<?php

namespace App\Controllers;

use App\Models\ComicModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

class Comic extends BaseController
{
    public function index()
    {
        $comicModel = new ComicModel();
        $comic = $comicModel->getComic();

        return view('pages/comic',[
            'title' => 'Comic',
            'comics' => $comic
        ]);
    }

    public function detail($slug){
        $comic = new ComicModel();
        $getDetailComic = $comic->getComic($slug);
        
        if (!$getDetailComic) {
            throw new PageNotFoundException("Judul komik $slug tidak ditemukan");
        }

        return view('pages/detailcomic',[
            'title' => $getDetailComic['judul'],
            'comic' => $getDetailComic
        ]);
    }

    public function create(){
        return view('pages/createcomic',[
            'title' => 'New Comic',
            'validation' => Services::validation()
        ]);
    }

    public function createaction(){
        $validation = $this->validate([
            'judul' => 'required|is_unique[comic.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => 'required',
        ]);

        if (!$validation) {
            return redirect()->to('/comic/action/create')->withInput()->with('validation' , Services::validation());
        }

        $slug = url_title($this->request->getVar('judul'));

        $comic = new ComicModel();
        
        $comic->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        return redirect()->to('/comic')->with('message', 'Add Comic Sucessfully');
    }

    public function deleteaction($id){
        $comic = new ComicModel();
        $comic->delete($id);

        return redirect()->to('/comic')->with('deleted', 'Comic Success Deleted');
    }

    public function edit($slug){
        $comic = new ComicModel();
        $getComic = $comic->where('slug' , $slug)->first();
        
        return view('pages/editcomic',[
            'title' => 'Edit',
            'validation' => Services::validation(),
            'comic' => $getComic
        ]);
    }

    public function editaction($id){
        $oldComic = new ComicModel();
        $getOldComic = $oldComic->getComic($this->request->getVar('slug'));
        if ($getOldComic['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        }else {
            $rule_judul = 'required|is_unique[comic.judul]';
        }

        $validation = $this->validate([
            'judul' => $rule_judul,
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => 'required',
        ]);

        if (!$validation) {
            return redirect()->to('/comic/' . $this->request->getVar('slug') . '/edit' )->withInput()->with('validation' , Services::validation());
        }

        $slug = url_title($this->request->getVar('judul'));

        $comic = new ComicModel();

        $comic->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        
        return redirect()->to("/comic")->with('message', 'Edit Comic Sucessfully');
    }
}
