<?php
namespace App\controllers;

use App\controllers\Controller;
use App\models\Mail;
use App\models\Notifications;
use Delight\Auth\Auth;

class ResetPasswordController extends Controller
{
    private $notifications;

    public function __construct(Notifications $notifications)
    {
        parent::__construct();
        $this->notifications = $notifications;
    }

    public function showForm()
    {
        echo $this->engine->render('password-recovery');
    }

    public function recovery()
    {
        try {
            $this->auth->forgotPassword($_POST['email'], function ($selector, $token) {
                // send `$selector` and `$token` to the user (e.g. via email)
                $this->notifications->passwordReset($_POST['email'], $selector, $token);
                flash()->success(['Код сброса пароля был отправлен вам на почту.']);
            });

            // request has been generated
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Такая почта не зарегистрирована!']);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error(['Почта не подтверждена!']);
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            flash()->error(['Изменение пароля отключено пользователем!']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Превышен лимит!']);
        }
        return back();
    }

    public function showSetForm()
    {
        if ($this->auth->canResetPassword($_GET['selector'], $_GET['token'])) {
            // put the selector into a `hidden` field (or keep it in the URL)
            // put the token into a `hidden` field (or keep it in the URL)

            // ask the user for their new password
            echo $this->engine->render('password-set', ['data'    =>  $_GET]);
        }
//        echo $this->engine->render('password-set', ['data'    =>  $_GET]);

    }

    public function change()
    {
        try {
            $this->auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);

            flash()->success(['Пароль успешно изменен.']);
            return redirect('/login');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error(['Неверный токен']);
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error(['Токен просрочен']);
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            flash()->error(['Изменение пароля отключено пользователем']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error(['Введите пароль']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Превышен лимит.']);
        }

        return back();
    }
}