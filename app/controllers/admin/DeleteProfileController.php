<?php

namespace App\controllers\admin;

class DeleteProfileController extends Controller{

    public function delete($id){

            $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
            $this->db->delete('users', $id);
            $this->db->delete('profile', $user['id']);
            $this->auth->logOut();
            return redirect('/admin');
            exit;
    }

}