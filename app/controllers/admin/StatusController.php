<?php

namespace App\controllers\admin;

class StatusController extends Controller
{
    public function statusShow($id)
    {
        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('admin/status', ['user' => $user, 'auth_id' => $auth_id]);
    }

    public function status($id)
    {
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        $this->db->update('profile', ['status' => $_POST['status']], $user['id']);
        flash()->success(['Status success update']);
        redirect("/admin/user/{$user['user_id']}/status");
    }
}
