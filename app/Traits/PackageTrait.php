<?php
namespace App\Traits;

trait PackageTrait
{
    public static function getAllPackageJsonData() {
        //Load the file
        $contents = file_get_contents(base_path('app/Models/package.json'));

        //Decode the JSON data into a PHP array.
        $contentsDecoded = json_decode($contents, true);

        return $contentsDecoded;
    }

    public static function findOnePackageJsonDataById($transaction_id) {
        //Load the file
        $contents = file_get_contents(base_path('app/Models/package.json'));

        //Decode the JSON data into a PHP array.
        $contentsDecoded = json_decode($contents, true);

        $package = collect($contentsDecoded)->where('transaction_id', $transaction_id)->first();

        return $package;
    }

    public static function saveDataIntoPackageJson($params=[]) {
        $data[] = $params;
        $contents = file_get_contents(base_path('app/Models/package.json'));
        $tempArray = json_decode($contents, true);

        // validate
        $validate = self::validateParams($tempArray, $params['transaction_id']);
        if(!$validate){
            return false;
        }

        // insert params into json
        array_push($data, $tempArray);

        // save data
        $jsonData = json_encode($data);
        file_put_contents(base_path('app/Models/package.json'), $jsonData);

        // get saved data
        $savedContents = file_get_contents(base_path('app/Models/package.json'));
        $package = json_decode($savedContents, true);

        return $package;
    }

    public static function validateParams($tempArray=[], $trxId) {
        if(!$tempArray){
            return true;
        }

        if(is_array(current($tempArray))){
            if(in_array($trxId, $tempArray)){
                return false;
            }
        }else{
            if($tempArray['transaction_id'] == $trxId){
                return false;
            }
        }

        return true;

    }

    public static function updateDataIntoPackageJson($params=[], $trxId) {
        $data[] = $params;
        $contents = file_get_contents(base_path('app/Models/package.json'));
        $tempArrays = json_decode($contents, true);

        // validate
        $validate = self::checkTransactionExistOrNot($tempArrays,$trxId);
        if(!$validate){
            return false;
        }

        if(is_array(current($tempArrays))){
            foreach($tempArrays as $tempArray){ // now iterate through that array

                if($tempArray['transaction_id'] ==$trxId){ // check all conditions
                    $params['transaction_id'] = $trxId;

                    // update params into json
                    array_replace($tempArray, $params);
                    break;
                }
            }
        }else{
            $tempArrays = array_replace($tempArrays, $params);
        }

        // update data
        $jsonData = json_encode($tempArrays);
        file_put_contents(base_path('app/Models/package.json'), $jsonData);

        // get update data
        $savedContents = file_get_contents(base_path('app/Models/package.json'));
        $package = json_decode($savedContents, true);

        return $package;
    }

    public static function checkTransactionExistOrNot($tempArrays=[], $trxId) {
        if(!$tempArrays){
            return false;
        }

        if(is_array(current($tempArrays))){
            if(in_array($trxId, $tempArrays)){
                return false;
            }
        }else{
            if(isset($tempArrays['transaction_id'])){
                if($tempArrays['transaction_id'] == $trxId){
                    return false;
                }
            }
        }

        return true;

    }

    public static function deleteDataFromPackageJson($params=[], $transaction_id) {
        $data[] = $params;
        $contents = file_get_contents(base_path('app/Models/package.json'));
        $tempArrays = json_decode($contents, true);

        // validate
        $validate = self::checkTransactionExistOrNot($tempArrays, $transaction_id);
        if(!$validate){
            return false;
        }

        if(is_array(current($tempArrays))){
            foreach($tempArrays as $tempArray => $item){ // now iterate through that array
                if($item['transaction_id'] == $transaction_id){ // check all conditions
                    // delete package
                    unset($tempArrays[$tempArray]);
                    break;
                }
            }
        }else{
            $tempArrays = array();
        }

        // update data
        $jsonData = json_encode($tempArrays);
        file_put_contents(base_path('app/Models/package.json'), $jsonData);

        // get update data
        $savedContents = file_get_contents(base_path('app/Models/package.json'));
        $package = json_decode($savedContents, true);

        return $tempArrays;
    }

}
