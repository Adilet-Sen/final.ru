<?php

namespace App\controllers\admin;

use App\controllers\admin\Controller;
use App\models\ImageManager;

use function DI\create;

class CreateUserPage extends Controller
{
    public function createShow()
    {
        $this->checkForAccess();
        echo $this->engine->render('admin/create_user', ['title' => 'Создать пользователя']);
    }

    public function create()
    {
        $this->checkForAccess();
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email'],
        ];
        try {
            $userId = $this->auth->register($data['email'], $data['password'], $data['username'], function ($selector, $token) {
                $this->auth->confirmEmail($selector, $token);
            });
        } catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Invalid email address']);
            redirect('/admin/create_user');
            exit;
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error(['Invalid password']);
            redirect('/admin/create_user');
            exit;
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['User already exists']);
            redirect('/admin/create_user');
            exit;
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Too many requests']);
            redirect('/admin/create_user');
            exit;
        }
        if (!isset($_FILES['avatar'])) {
            $img = new ImageManager($_FILES);
            $pathImg = $img->imageUpload();
        }

        $data = [
            'work_place' => $_POST['work_place'],
            'address' => $_POST['address'],
            'avatar' => $imgs = $pathImg ? $pathImg : 'uploads/no-user.png',
            'tags' => slugify($_POST['username']),
            'number' => $_POST['number'],
            'status' => $_POST['status'],
            'vk' => $_POST['vk'],
            'telegram' => $_POST['telegram'],
            'instagram' => $_POST['instagram'],
            'user_id' => $userId,
        ];

        $this->db->insert('profile', $data);
        flash()->success(['Профиль пользоватля создан']);
        redirect('/admin/create_user');
        exit;
    }
}
