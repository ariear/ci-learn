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
            'sampul' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation' , Services::validation());
        }
        
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $sampulName = 'default.png';
        }else{
            $sampulName = $fileSampul->getRandomName();
            $fileSampul->move('img', $sampulName);
        }


        $slug = url_title($this->request->getVar('judul'));

        $comic = new ComicModel();
        
        $comic->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $sampulName,
        ]);


        return redirect()->to('/comic')->with('message', 'Add Comic Sucessfully');
    }

    public function deleteaction($id){
        $comic = new ComicModel();

        $getComic = $comic->find($id);

        if ($getComic['sampul'] != 'default.png' ) {
            unlink('img/' . $getComic['sampul']);
        }

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
            'sampul' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
        ]);

        if (!$validation) {
            return redirect()->to('/comic/' . $this->request->getVar('slug') . '/edit' )->withInput()->with('validation' , Services::validation());
        }

        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $sampulName = $this->request->getVar('sampulLama');
        }else{
            $sampulName = $fileSampul->getRandomName();
            $fileSampul->move('img', $sampulName);

            if ($this->request->getVar('sampulLama') != 'default.png' ) {
                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        $slug = url_title($this->request->getVar('judul'));

        $comic = new ComicModel();

        $comic->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $sampulName,
        ]);
        
        return redirect()->to("/comic")->with('message', 'Edit Comic Sucessfully');
    }
}
