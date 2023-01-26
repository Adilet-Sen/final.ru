<?php
namespace App\controllers;


use App\models\RegistrationService;
use Delight\Auth\Auth;

class VerificationController extends Controller
{
    public function verify()
    {
        try {
            $this->auth->confirmEmail($_GET['selector'], $_GET['token']);

            flash()->success(['Ваш email подвержден! Можете авторизоваться!']);
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error(['Неверный токен']);
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error(['Неверный испортился']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email уже существует']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Куда ломишься!??!']);
        }

        return redirect('/login');


    }
}