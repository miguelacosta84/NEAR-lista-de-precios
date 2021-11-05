<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateMyListRequest;
use App\Http\Requests\CreateItemRequest;
use App\Services\MyListService;
use Laracasts\Flash\Flash;

class MyListController extends Controller
{

    private $service;

    public function __construct(MyListService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function datatable(Request $request) {
        $table = $this->service->dataTable($request);
        return $table;
    }

    public function index() {
        return view('mylist.index');
    }

    public function store(CreateMyListRequest $request) {
        $apiError = $this->service->add($request);
        return response()->json($apiError);
    }

    public function addItem(Request $request) {
        $apiError = $this->service->addItem($request);
        return response()->json($apiError);
    }

    public function showItems(Request $request) {
        $apiError = $this->service->showItems($request);
        return response()->json($apiError);
    }

    public function deleteItem(Request $request) {
        $apiError = $this->service->deleteItem($request);
        return response()->json($apiError);
    }

}
