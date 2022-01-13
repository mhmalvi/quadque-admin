<?php
class AppUrl 
{

  public static  function lastPartOfUrl() 
  {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $lastPart = array_pop($url);
    
        return $lastPart;
    }

  public static function pathFilter()
  {
    
    $lastPart = self::lastPartOfUrl();

    if($lastPart != 'signin'){

        return true;

    } else {

        return false;

    }
  }


}