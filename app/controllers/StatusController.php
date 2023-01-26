<?php

namespace App\controllers;

class StatusController extends Controller
{
    public function statusShow($id)
    {

        $this->checkIdIdentyUser($id);
        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('status', ['user' => $user, 'auth_id' => $auth_id]);
    }

    public function status($id)
    {
        $this->checkIdIdentyUser($id);
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        $this->db->update('profile', ['status' => $_POST['status']], $user['id']);
        flash()->success(['Status success update']);
        redirect("/user/{$user['user_id']}/status");
    }
}
