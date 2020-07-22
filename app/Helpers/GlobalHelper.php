<?php

namespace App\Helpers;

class GlobalHelper
{
    public static function createResponse($error = true, $message='', $data=[] )
    {
       if($error){
          $response = [
              'error' => $error,
              'message' => $message
           ];
       }else{
          if($data){
               $response = [
                  'error' => $error,
                  'message' => $message,
                  'data' => $data,
               ];
          }else{
               $response = [
                  'error' => $error,
                  'message' => $message
               ];
          }

       }

        return $response;
    }

}
