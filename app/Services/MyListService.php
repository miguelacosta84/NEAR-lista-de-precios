<?php

namespace App\Services;

use App\Interfaces\IServices;
use App\Models\ApiError;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use App\Exceptions\AppException;
use Laracasts\Flash\Flash;
use App\Models\MyList;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MyListService  implements IServices
{

    public function dataTable(Request $request){
        $apiError =  new ApiError();
        $table = MyList::All();
        try {
            return Datatables::of($table)->make(true);

        }catch(AppException $ex){
            $apiError->setError($ex->getMessage());
        }catch(\Exception $ex ){
            $apiError->setError($ex->getMessage());
        }

        return $apiError;
    }

    public function add(Request $request){

        $apiError =  new ApiError();

        try{
            $input = $request->all();
            $row = MyList::create($input);
            $apiError->modelo = $row;
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
        }catch(\Exception $ex ){
            $apiError->setError("Error, consulte con su administrador.");        }
        return $apiError;
    }

    public function addItem(Request $request){

        $apiError =  new ApiError();

        try{

            $user = Auth::user();
            $response = Http::get('https://api.first.org/data/v1/countries');

            $data = array(
                "name"     => $request->name,
                "price"    => $request->price,
                "store"    => $request->store,
                "myListId" => $request->myListId
            );

            $response = Http::post('https://bf0a-201-165-221-194.ngrok.io/call', [
                'account_id'  => $user->accountId,
                'private_key' => $user->privateKey,
                'contract' => $user->accountId,
                'method' => 'addProduct',
                "params" => $data
            ]);

            $jsonData = $response->json();
            $apiError->modelo = $jsonData;
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
        }catch(\Exception $ex ){
            $apiError->setError("Error, consulte con su administrador.");        }
        return $apiError;
    }

    public function showItems(Request $request){

        $apiError =  new ApiError();

        try{

            $user = Auth::user();

            $data = array(
                "listId" => $request->myListId
            );

            $response = Http::post('https://bf0a-201-165-221-194.ngrok.io/view', [
                'contract' => $user->accountId,
                'method' => 'getAllProductsByListId',
                "params" => $data
            ]);

            $jsonData = $response->json();
            $apiError->data = $jsonData;
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
        }catch(\Exception $ex ){
            $apiError->setError("Error, consulte con su administrador.");        }
        return $apiError;
    }

    public function deleteItem(Request $request){

        $apiError =  new ApiError();

        try{

            $user = Auth::user();
            $response = Http::get('https://api.first.org/data/v1/countries');

            $data = array(
                "key" => $request->id
            );

            $response = Http::post('https://bf0a-201-165-221-194.ngrok.io/call', [
                'account_id'  => $user->accountId,
                'private_key' => $user->privateKey,
                'contract'    => $user->accountId,
                'method'      => 'deleteProduct',
                "params"      => $data
            ]);

            $jsonData = $response->json();
            $apiError->modelo = $jsonData;
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
        }catch(\Exception $ex ){
            $apiError->setError("Error, consulte con su administrador.");        }
        return $apiError;
    }

    public function update($id,Request $request){
        $apiError = new ApiError();

        try{
            $row = $this->find($id);
            $input = $request->all();
            $row->update($input);
            Flash::success(__('Registro actualizado correctamente'));
            $description = "update" . " " . $row->name;
            $this->saveHistory('patch','filetype.update', $description);
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
            $this->setLog($ex->getMessage(), SystemLog::Exception);
            Flash::error(__('Error, intente de nuevo más tarde'));
        }catch(\Exception $ex ){
            $apiError->setError($ex->getMessage());
            $this->setLog($ex->getMessage(), SystemLog::Exception);
            Flash::error(__('Error, intente de nuevo más tarde'));
        }
        return $apiError;
    }

    public function find($id){
        return FileType::find($id);
    }

    public function getById($id){
        $apiError =  new ApiError();
        $row = FileType::where('id',$id)->first();
        $apiError->modelo = $row;
        $description = "getById " . "Archivo " . $row->name;
        $this->saveHistory('get','filetype.getById', $description);
        return $apiError;
    }

    public function all(Request $request){

    }

    public function active($id,$enabled){
        $apiError =  new ApiError();
        try{
            $row = $this->find($id);
            if($row == null){
                throw new AppException(__('Registro no encontrado'));
            }
            $row->enabled = $enabled;
            $row->save();
            $apiError->modelo = $row;
            $description = "active" . " " . $row->name  . " " . $enabled;
            $this->saveHistory('post','filetype.active', $description);
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
            $this->setLog($ex->getMessage(), SystemLog::Exception);
        }catch(\Exception $ex ){
            $apiError->setError($ex->getMessage());
            $this->setLog($ex->getMessage(), SystemLog::Exception);
        }
        return $apiError;
    }

    public function delete($id){

        $apiError =  new ApiError();
        try{
            $row = $this->find($id);

            if($row == null){
                throw new AppException(__('Registro no encontrado'));
            }

            $row->trash = 1;
            $row->save();
            Flash::success(__('Registro eliminado correctamente'));
            $apiError->modelo = $row;
            $description = "delete file" . " " . $row->name;
            $this->saveHistory('post','filetype.delete', $description);
        }catch(AppException $ex ){
            $apiError->setError($ex->getMessage());
            Flash::error(__('Error, intente de nuevo más tarde'));
            $this->setLog($ex->getMessage(), SystemLog::Exception);
        }catch(\Exception $ex ){
            $apiError->setError($ex->getMessage());
            $this->setLog($ex->getMessage(), SystemLog::Exception);
            Flash::error(__('Error, intente de nuevo más tarde'));
        }

        return $apiError;
    }

    public function validator(array $data, $id = 0) {
        $rules = [
            'name'       => 'required|string',
            'extension'  => 'required|string',
        ];
        return Validator::make($data, $rules);
    }
}
