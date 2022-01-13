<?php 
namespace App\CrudInterface;

interface StoreOrUpdate
{
    public function storeUpdate($request, $id, $method);
}