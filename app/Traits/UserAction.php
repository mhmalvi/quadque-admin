<?php 
namespace App\Traits;
use Auth;

trait UserAction
{
    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::user();
           $model->created_by = $user->id;
       });
       static::updating(function($model)
       {
           $user = Auth::user();
           $model->updated_by = $user->id;
       });

       static::updating(function($model)
       {
           $user = Auth::user();
           $model->deleted_by = $user->id;
       });

    //    static::deleting(function($model){

    //     $user = Auth::user();
    //     $model->deleted_by = $user->id;

    //    });
   }
}