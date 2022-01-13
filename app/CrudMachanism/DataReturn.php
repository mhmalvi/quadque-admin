<?php 
namespace App\CrudMachanism;

class DataReturn
{
    
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public  function getResult()
    {
        return $this->data;
    }
}