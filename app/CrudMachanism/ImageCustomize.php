<?php 
namespace App\CrudMachanism;

use AppUrl;

class ImageCustomize
{
    public static function customize($directory, $fileName)
    {
        $image = '<img style = "width:50px; height: 50px;" src="'.url('/').'/uploads/'.$directory.'/'.$fileName.'">';
        return $image;
    }

    public static function editImage($directory, $fileName)
    {
        $image = url('/public/uploads/'.$directory.'/'.$fileName);
        return $image;
    }
}