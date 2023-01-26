<?php

namespace App\models;

use Bulletproof\Image;

class ImageManager
{
    private $folder;
    private $image;

    public function __construct($image)
    {
        $this->folder = 'uploads';
        $this->image = new Image($image);
    }

    public function imageUpload($currentImage = null)
    {
        $this->deleteImage($currentImage);

        if ($this->image['avatar']) {
            $this->image->upload();
        }
        return $this->image->getFullPath();
    }

    public function checkImageExists($path)
    {
        if ($path != null && is_file($path) && file_exists($path)) {
            return true;
        }
    }

    public function deleteImage($image)
    {
        if ($this->checkImageExists($image)) {
            unlink($image);
        }
    }

    public function getDimensions($file)
    {
        if ($this->checkImageExists($file)) {
            return "$this->image->getWidth() $this->image->getWidth()";
        }
    }

    function getImage($image)
    {

        if ($this->checkImageExists($image)) {
            return '/' . $this->folder . $image;
        }

        return '/img/no-user.png';
    }
}
