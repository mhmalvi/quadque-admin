<?php
namespace App\Uploads;
use Symfony\Component\HttpFoundation\File\getClientOriginalName;

class FileUpload
{
    private $request;
    private $field_name;
    private $id;
    private $directory;
    private $method;
    private $model=null;

    public function __construct($request, $options)
    {
       
      $this->request    = $request;
      $this->field_name = $options['field_name'];
      $this->directory  = $options['directory'];  
      $this->id         = $options['id'];
      $this->method     = $options['method'];  
      $this->model      = $options['model'];  

    }

    
    public  static function setOptions($id, $model, $method, $field_name, $directory)
    {
        $options = [
            'id'         => $id,
            'model'      => $model,
            'method'     => $method,
            'field_name' => $field_name,
            'directory'  => $directory,            
        ];

        return $options;
    }

    public function imgProcess()
    {  
        
        $image_path = public_path($this->directory);
        
        if($this->method == 'store'){

            if($this->request->hasFile($this->field_name)){               
                $imageArr = [];

                if(is_array($this->request->file($this->field_name))){

                    foreach ($images = $this->request->file($this->field_name) as $key => $img) {

                        if(!empty($img)){

                        // $extension = $img->getClientOriginalExtension();
                        $fileName = $img->getClientOriginalName();
                        $img->move($image_path, $fileName); 

                        }

                        $imageArr[$key][$this->field_name] = $fileName; 
                    }  

                    return $imageArr;

                } else {

                    $image = $this->request->file($this->field_name);
                    // $extension = $image->getClientOriginalExtension();
                    $fileName = $image->getClientOriginalName();
                    // $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                    $image->move($image_path, $fileName);  

                }

            } else {

                $fileName = null;

            }

            return $fileName;

        } elseif($this->method == 'update') {

            $getImage = $this->model::find($this->id)[$this->field_name];

            if($this->request->hasFile($this->field_name)){
            
                $imageArr = [];
                
                if(is_array($this->request->file($this->field_name))){

                    foreach ($images = $this->request->file($this->field_name) as $key => $img) {

                        if(!empty($img)){

                        // $extension = $img->getClientOriginalExtension();
                        $fileName = $img->getClientOriginalName();
                        // $fileName    = $pic_owner.$key.date('d-m-Y').'-'.time().'.'.$extension;
                        $img->move($image_path, $fileName); 

                        }

                        $imageArr[$key][$this->field_name] = $fileName; 
                    }  

                    return $imageArr;

                } else {
                    
                    if(!empty($getImage)){

                        unlink($image_path.'/'.$getImage);
                        
                    } 
    
                    $image       = $this->request->file($this->field_name);
                //    $extension   = $image->getClientOriginalExtension();
                    $fileName = $image->getClientOriginalName();
                //    $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                    $image->move($image_path, $fileName);

                }
            

            } else {

                $fileName = $getImage;     

            }

            return $fileName;
        }      
        
    }
}