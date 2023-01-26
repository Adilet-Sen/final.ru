<?php

namespace App\controllers;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use App\models\QueryBuilder;
use App\models\Roles;
use League\Plates\Engine;
use Delight\Auth\Auth;

class Controller
{
    protected $engine;
    protected $db;
    protected $auth;
    public function __construct()
    {
        global $container;
        $this->db = $container->get(QueryBuilder::class);
        $this->auth = $container->get(Auth::class);
        $this->engine = $container->get(Engine::class);
    }

    public function checkForAccess()
    {
        if ($this->auth->hasRole(Roles::USER)) {
            return redirect('/');
        }
    }

    public function checkIdIdentyUser($id)
    {
        if (!($id == $this->auth->getUserId())) {
            abort(404);
        }
    }


    protected function validate($validator)
    {
        try {
            $validator->assert(array_merge($_POST, $_FILES));

        } catch (ValidationException $exception) {
            $exception->getMessages($this->getMessages());
            flash()->error($exception->getMessages());

            return back();
        }
    }

    protected function getMessages()
    {
        return [
            'username' => 'Введите имя не менее 3 символов',
            'email' => 'Неверный формат e-mail',
            'password'  =>  'Введите пароль',
            'password_confirmation' =>  'Пароли не сопадают',
            'number' => 'Неверный формат номера',
            'avatar' => 'Неверный формат картинки',
            'work_place' => 'Адрес должен состоять из символов'
        ];
    }
}
