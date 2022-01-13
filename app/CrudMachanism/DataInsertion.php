<?php
namespace App\CrudMachanism;

use App\CrudMessage\CrudMessage;
use Carbon\Carbon;

class DataInsertion
{
    private $model;
    private $method;
    private $message_text;
    private $data;
    private $id = null;
    public $getData; 

    public function __construct($model, $method, $message_text, $data, $id)
    {
      $this->model = $model;
      $this->method = $method;
      $this->message_text = $message_text;   
      $this->data = $data;
      $this->id = $id;
    }
    
    public function crudItem()
    {
        if($this->method == 'store'){
            $this->data['created_at'] = Carbon::now();
            $this->getData            = $this->model::create($this->data);   
            $message                  = new CrudMessage($this->message_text);
            return $message->createMsg();

        }

        if($this->method == 'update'){
            
            $this->model::find($this->id)->update($this->data); 
            $this->getData  = $this->model::find($this->id);
            $message        = new CrudMessage($this->message_text);
            return $message->updateMsg();

        }
    }

    public function massCrudItem()
    {
        if($this->method == 'store'){
          
            $this->data['created_at'] = Carbon::now();
            $this->model::insert($this->data);   
            $message = new CrudMessage($this->message_text);
            return $message->createMsg();

        }

        if($this->method == 'update'){
            
            $this->model::find($this->id)->update($this->data); 
            $message = new CrudMessage($this->message_text);
            return $message->updateMsg();

        }
    }
}