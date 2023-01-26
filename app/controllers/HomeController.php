<?php

namespace App\controllers;

class HomeController extends Controller
{
    public function about()
    {

        $auth_id = $this->auth->getUserId();
        $this->checkForAccess();
        echo $this->engine->render('about', ['title' => 'Home', 'auth_id' => $auth_id]);
    }

    public function usersShow()
    {

        $auth_id = $this->auth->getUserId();

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 8;
        $users = $this->db->all('profile', 'INNER', 'users',$page, $perPage);

        $paginator = paginate(
            $this->db->getCount('profile'),
            $page,
            $perPage,
            '/?page=(:num)'
        );

        echo $this->engine->render('users', [
            'users' => $users,
            'auth_id' => $auth_id,
            'paginator' => $paginator
        ]);
    }
}
