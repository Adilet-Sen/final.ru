<?php

namespace App\controllers;

class ProfileController extends Controller
{
    public function profileShow($id)
    {
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('profile', ['user' => $user]);
    }
}
