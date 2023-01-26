<?php

namespace App\controllers;

use App\models\RegistrationService;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class RegisterController extends Controller
{
    private $registration;
    public function __construct(RegistrationService $registrationService)
    {
        parent::__construct();
        $this->registration = $registrationService;
    }

    public function registerShow()
    {
        echo $this->engine->render('register', ['name' => 'Home']);
    }

    public function register()
    {
        $data = $_POST;
        $this->vvalidate();
        try {
            $data = $this->registration->make($data['email'], $data['password'], $data['username']);
            flash()->success(['На вашу почту ' . $_POST['email'] . ' был отправлен код с подтверждением.']);
            $this->db->insert('profile', ['user_id' => $data]);
            return redirect('/login');
        } catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Invalid email address']);
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error(['Invalid password']);
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['User already exists']);
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Too many requests']);
        }

        return redirect('/register');
    }

    private function vvalidate()
    {
        $validator = v::key('username', v::stringType()->notEmpty())
            ->key('email', v::email())
            ->key('password', v::stringType()->notEmpty())
            ->keyValue('password_confirmation', 'equals', 'password');

        try {
            $validator->assert($_POST);

        } catch (ValidationException $exception) {
            $exception->getMessages($this->ggetMessages());
            flash()->error($exception->getMessages());

            return redirect('/register');
        }
    }

    private function ggetMessages()
    {
        return [
            'username' => 'Введите имя не менее 3 символов',
            'email' => 'Неверный формат e-mail',
            'password'  =>  'Введите пароль',
            'password_confirmation' =>  'Пароли не сопадают'
        ];
    }
}
