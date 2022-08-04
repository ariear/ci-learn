<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $users = new UserModel();

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1 ;
        
        $searchName = $this->request->getVar('name');
        if ($searchName) {
            $datauser = $users->search($searchName);
        }else{
            $datauser = $users->search();
        }
        
        return view('pages/users',[
            'title' => 'Users',
            'users' => $datauser->paginate(10, 'user'),
            'pager' => $users->pager,
            'currentPage' => $currentPage
        ]);
    }
}
