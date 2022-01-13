<?php 
namespace App\SearchEngine;


class SearchEngine
{
    private $searchable;
    private $options;

    public function __construct($searchable, $options)
    {
       $this->searchable = $searchable; //search able field there
       $this->options = $options; //inclusive there request data and model
    }

    public function search()
    {
        $search = $this->options['data']->search;
        $dataSorting = $this->options['data']->sorting == 'false'?10:$this->options['data']->sorting;

        $searchableField = $this->searchable;

        
        
        $data = $search == 'false'?$this->options['model']::orderBy('id', 'desc')->paginate($dataSorting):$this->options['model']::where(function($query) use($search, $searchableField){

            foreach ($searchableField as $key => $field) {

                $query->orWhere($field, 'LIKE', "%{$search}%");

            }
        
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return $data;

    }
}