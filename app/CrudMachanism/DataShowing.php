<?php

namespace App\CrudMachanism;

class DataShowing
{
    public static function dataShow($model, $id, $resource)
    {
        $data = $model::find($id);
        return new $resource($data);
    }

    /**
     * Returns a model data by it's resource
     * @param $model_data Any Model object
     */
    public static function fetch($model_data, $resource)
    {
        return new $resource($model_data);
    }
}
