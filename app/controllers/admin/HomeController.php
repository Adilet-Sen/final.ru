<?php

namespace App\controllers\admin;

use App\controllers\admin\Controller;

class HomeController extends Controller
{
    public function about()
    {
        $this->checkForAccess();
        echo $this->engine->render('about', ['title' => 'Home']);
    }

    public function usersShow()
    {
        $auth_id = $this->auth->getUserId();
        $this->checkForAccess();

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 8;
        $users = $this->db->all('profile', 'INNER', 'users',$page, $perPage);

        $paginator = paginate(
            $this->db->getCount('profile'),
            $page,
            $perPage,
            '/admin/?page=(:num)'
        );

        echo $this->engine->render('admin/users', [
            'users' => $users,
            'auth_id' => $auth_id,
            'paginator' => $paginator
        ]);
    }
}
