<?php

namespace App\controllers;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
class UpdateController extends Controller
{
    public function editShow($id)
    {
        $this->checkIdIdentyUser($id);
        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('edit', ['user' => $user, 'auth_id'=> $auth_id]);
    }

    public function edit($id)
    {
        $validate = v::key('username', v::stringType()->notEmpty())
            ->key('work_place', v::stringType())
            ->key('number', v::Phone())
            ->key('address', v::stringType());

        $this->validate($validate);
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        $this->db->update('users', ['username' => $_POST['username']], $user['user_id']);
        $this->db->update('profile', [
            'work_place' => $_POST['work_place'],
            'number' => $_POST['number'],
            'address' => $_POST['address']
        ], $user['id']);
        flash()->success(['Profile success update']);
        redirect("/user/{$user['user_id']}/edit");
        exit;
    }
}
