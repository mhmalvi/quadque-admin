<?php 
namespace App\SearchEngine;

use App\SearchEngine\SearchEngine;

class DataMachine
{
    private $searchable = [];
    /**
     * 
     * Example array('name', 'phone', 'nid')
     */
    private $request;
    private $model;
    private $resource_class;
    private $extra_data_collection = [];

     /**
      * Fetch data in a variable such as $departments = Department::all()
      * Pass an array to DataMachine class with index and data such as ['departments' => $departments]
      * remember it will be the last argument
      */
    
    public function __construct($searchable, $request, $model, $resource_class, $extra_data_collection)
    {
      $this->searchable            = $searchable;
      $this->request               = $request;
      $this->model                 = $model;
      $this->resource_class        = $resource_class;
      $this->extra_data_collection = $extra_data_collection;

    }

    /**
     * 
     * Example  $data = new DataMachine(array('name'), $request, Department::class, DepartmentResource::class, []);
     * Keep last argument empty if you don't have any extra data
     */

    public  function dataRendering() 
    {
        $options = [
            'data' => $this->request,
            'model' => $this->model,
        ];
        
        $searchItem = new SearchEngine($this->searchable, $options);
        $data = $searchItem->search();
      

        $result = $this->resource_class::collection($data)->additional($this->extra_data_collection);
        return $result;
    }
}