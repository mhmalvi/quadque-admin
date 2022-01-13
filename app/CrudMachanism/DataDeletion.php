<?php 
namespace App\CrudMachanism;

use App\CrudMessage\CrudMessage;

class DataDeletion
{
    public static function dataDelete($model, $id, $message)
    {
        $result = $model::find($id)->delete();

        if($result){
            $result =  new CrudMessage('Department');

            return $result->deleteMsg();
        }
    }
}