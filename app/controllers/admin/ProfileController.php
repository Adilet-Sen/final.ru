<?php

namespace App\controllers\admin;

class ProfileController extends Controller
{
    public function profileShow($id)
    {
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('admin/profile', ['user' => $user]);
    }
}
