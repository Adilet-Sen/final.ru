<?php

namespace App\controllers;

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

        $this->checkIdIdentyUser($id);
        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);

        echo $this->engine->render('security', ['user' => $user, 'auth_id' => $auth_id]);
    }

    public function security_password($id)
    {
        $this->checkIdIdentyUser($id);
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        try {
            $this->auth->changePassword($_POST['password'], $_POST['new_password']);
            flash()->success(['Пароль успешно изменен.']);
            redirect("/user/{$user['user_id']}/security");
            // password has been changed
        } catch (\Delight\Auth\NotLoggedInException $e) {
            // not logged in
            flash()->error(['Залогиньтесь!']);
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            // invalid password(s)
            flash()->error(['Неправильный пароль!']);
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            // too many requests
            flash()->error(['Куда ломишься!']);
        }

        redirect("/user/{$user['user_id']}/security");
    }

    public function security_email($id)
    {
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        try {
            $this->auth->changeEmail($_POST['newEmail'], function ($selector, $token) {
                $this->notifications->emailWasChanged($_POST['newEmail'], $selector, $token);
                flash()->success(['На вашу почту ' . $_POST['newEmail'] . ' был отправлен код с подтверждением.']);
            });

            flash()->success('Вам необходимо подтведить почту для авторизации!');
            redirect('/logout');
        } catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Invalid email address']);
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email address already exists']);
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error(['Account not verified']);
        } catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error(['Not logged in']);
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Too many requests']);
        }
        redirect("/user/{$user['user_id']}/security");
    }

}
