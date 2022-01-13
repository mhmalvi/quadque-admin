<?php 
namespace App\CrudInterface;

interface Message
{
    public function createMsg();
    public function updateMsg();
    public function deleteMsg(); 
}