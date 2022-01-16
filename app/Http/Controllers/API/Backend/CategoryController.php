<?php

namespace App\Http\Controllers\API\Backend;

use App\CrudMachanism\DataDeletion;
use App\CrudMachanism\DataInsertion;
use App\CrudMachanism\DataShowing;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogRequest;
use App\SearchEngine\DataMachine;
use App\Uploads\FileUpload;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchable = [
            'title',
        ];

        $extraData = [];

        $result = new DataMachine($searchable, $request, Blog::class, BlogResource::class, $extraData);

        return  $result->dataRendering();
    }

    public function storeUpdate($request, $id, $method)
    {

        $options         = FileUpload::setOptions($id, Blog::class, $method, 'image', 'uploads/post');
        $file            = new FileUpload($request, $options);
        $fileName        = $file->imgProcess();

        $optionsIcon         = FileUpload::setOptions($id, Blog::class, $method, 'feature_image', 'uploads/post');
        $fileIcon            = new FileUpload($request, $optionsIcon);
        $fileNameIcon        = $fileIcon->imgProcess();



        $data = $request->except([
            'image',
            'feature_image',
        ]);

        $data['slug']          = strtolower(str_replace(' ', '-', $request->name));
        $data['image']         = $fileName;
        $data['feature_image'] = $fileNameIcon;
        $operation             = new DataInsertion(Blog::class, $method, 'post', $data, $id);
        $result                = $operation->crudItem();

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $result =  $this->storeUpdate($request, '', 'store');
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DataShowing::dataShow(Blog::class, $id, BlogResource::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result =  $this->storeUpdate($request, $id, 'update');
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result =  DataDeletion::dataDelete(Blog::class, $id, 'post');
        return $result;
    }
}
