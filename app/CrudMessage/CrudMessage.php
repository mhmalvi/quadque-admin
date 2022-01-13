<?php 
namespace App\CrudMessage;

use App\CrudInterface\Message;

class CrudMessage implements Message
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;   
    }
    
    public function createMsg()
    {
        return response()->json([ 
            'status'  => 'success',
            'message' => $this->message.' has been created',    
        ]);
    }

    public function updateMsg()
    {
        return response()->json([
            'status'  => 'success',
            'message' => $this->message.' has been updated',    
        ]);
    }

    public function deleteMsg()
    {
        return response()->json([
            'status'  => 'danger',
            'message' => $this->message.' has been deleted',    
        ]);
    }
}