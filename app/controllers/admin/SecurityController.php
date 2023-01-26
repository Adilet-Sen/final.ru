<?php

namespace App\controllers\admin;

use App\models\Notifications;

class SecurityController extends Controller
{
    private $notifications;

    public function __construct(Notifications $notifications)
    {
        parent::__construct();
        $this->notifications = $notifications;
    }

    public function securityShow($id)
    {

        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);

        echo $this->engine->render('admin/security', ['user' => $user, 'auth_id' => $auth_id]);
    }

    public function security_password($id)
    {
        try {
            $this->auth->admin()->changePasswordForUserById($id, $_POST['newPassword']);
            flash()->success('Success Password upgrade!');
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            flash()->success('Unknown ID');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->success('Invalid password');
        }

        redirect("/admin/user/{$id}/security");
    }

    public function security_email($id)
    {
        $this->db->update('users', ['email' => $_POST['newEmail'], 'verified' => '1'], $id);
        flash()->success('Success Email upgrade!');
        redirect("/admin/user/{$id}/security");
    }

}
