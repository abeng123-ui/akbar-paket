<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\PackageTrait;
use App\Models\Packages;
use App\Helpers\GlobalHelper;

class PackageController extends Controller
{
    use PackageTrait;

    public function list(Request $request) {
        $package = $this->getAllPackageJsonData();

        if((count($package) < 1 || $package != null) && !$package){
            $message = 'Data tidak ditemukan';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }

        $message = 'Sukses menampilkan data package';
        $response = GlobalHelper::createResponse(false, $message, $package);

        return $response;
    }

    public function listByTransactionId(Request $request, $transaction_id) {
        $package = $this->findOnePackageJsonDataById($transaction_id);

        if((count($package) < 1 || $package != null) && !$package){
            $message = 'Data tidak ditemukan';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }

        $message = 'Sukses menampilkan data package berdasarkan ID transaksi';
        $response = GlobalHelper::createResponse(false, $message, $package);

        return $response;
    }

    public function create(Request $request) {
        $params = $request->all();

        if(!isset($params['transaction_id'])){
            $message = 'ID transaksi tidak ada';
            $response = GlobalHelper::createResponse(true, $message);
            return $response;
        }

        $package = $this->saveDataIntoPackageJson($params);

        if(count($package) < 1){
            $message = 'Data gagal disimpan';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }elseif(!$package){
            $message = 'ID transaksi sudah ada';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }

        $message = 'Sukses menyimpan data package';
        $response = GlobalHelper::createResponse(false, $message, $package);

        return $response;
    }

    public function updateAll(Request $request, $transaction_id) {
        $params = $request->all();

        $package = $this->updateDataIntoPackageJson($params, $transaction_id);

        if(count($package) < 1){
            $message = 'Data gagal dirubah';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }elseif(!$package){
            $message = 'ID transaksi tidak ditemukan';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }

        $message = 'Sukses merubah data package';
        $response = GlobalHelper::createResponse(false, $message, $package);

        return $response;
    }

    public function delete(Request $request, $transaction_id) {
        $params = $request->all();

        $package = $this->deleteDataFromPackageJson($params, $transaction_id);

        if(!$package){
            $message = 'Data tidak ditemukan';
            $response = GlobalHelper::createResponse(false, $message);
            return $response;
        }

        $message = 'Sukses hapus data package by ID transaksi';
        $response = GlobalHelper::createResponse(false, $message, $package);

        return $response;
    }


}
