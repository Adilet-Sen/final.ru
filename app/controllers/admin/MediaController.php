<?php

namespace App\controllers\admin;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use App\models\ImageManager;

class MediaController extends Controller
{
    public function mediaShow($id)
    {
        $auth_id = $this->auth->getUserId();
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        echo $this->engine->render('admin/media', ['user' => $user, 'auth_id' => $auth_id]);
    }
    public function media($id)
    {
        $pathImg = '';
        $user = $this->db->getOneProfile('profile', 'INNER', 'users', $id);
        $validate = v::keyNested('avatar', v::optional(v::image()));
        $this->validate($validate);
        $img = new ImageManager($_FILES);

        if (isset($_FILES['avatar'])) {
            $pathImg = $img->imageUpload();
        }

        if ($user['avatar'] == 'uploads/no-user.png') {
        } else {
            $img->deleteImage($user['avatar']);
        }

        $this->db->update('profile', ['avatar' => (substr($pathImg, -1) == '.') ? 'uploads/no-user.png' : $pathImg ], $user['id']);
        redirect("/admin/user/{$user['user_id']}/media");
        exit;
    }
}
