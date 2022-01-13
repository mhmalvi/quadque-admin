<?php 
namespace App\CrudMachanism;

class DataShowing
{
    public static function dataShow($model, $id, $resource)
    {
        $data = $model::find($id);
        return new $resource($data);
    }
}