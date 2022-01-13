<?php 
namespace App\CrudMachanism;

use Carbon\Carbon;

class MassiveData
{
   

    public function __construct()
    {
        
    }

    

    public static function serviceDataProcessing($request)
    {
        $data = [];

        $serviceIds  = explode(",", $request->service_id[0]);

        foreach ($serviceIds as $key => $serviceId) {

            $data[$key]['user_id']    = $request->user_id;
            $data[$key]['service_id'] = $serviceId;
            $data[$key]['created_at'] = Carbon::now();
   
        }

        // return json_decode($request->service_id, true);

        return $data; 
    }


    public static function assignProviderService($request)
    {
        
        
        $data = [];

        $serviceIds  =  explode(",", $request['service_id'][0]);

        // return $serviceIds;

        foreach ($serviceIds as $key => $serviceId) {

            $data[$key]['user_id']    = $request['user_id'];
            $data[$key]['service_id'] = $serviceId;
            $data[$key]['created_at'] = Carbon::now();
   
        }

        // return json_decode($request->service_id, true);

        return $data; 
    }

    public static function packageServiceDataProcessing($request)
    {
        $data = [];

        $serviceIds  = explode(",", $request->service_id[0]);

        foreach ($serviceIds as $key => $serviceId) {

            $data[$key]['package_id']    = $request->package_id;
            $data[$key]['service_id'] = $serviceId;
            $data[$key]['created_at'] = Carbon::now();
   
        }

        // return json_decode($request->service_id, true);

        return $data; 
    }

    public static function galleryImageProcessing($request)
    {

        $data = [];

        

        foreach ($request as $key => $image) {

            $data[$key]    = $image;
            $data[$key] = Carbon::now();
   
        }

        // return json_decode($request->service_id, true);

        return $data; 

    }

}