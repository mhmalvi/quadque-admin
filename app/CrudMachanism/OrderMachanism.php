<?php 
namespace App\CrudMachanism;

class OrderMachanism
{
    public $requestData;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }
}