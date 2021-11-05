<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface  IServices
{
    public function dataTable(Request $request);
    public function add(Request $request);
    public function update($id,Request $request);
    public function all(Request $request);
    public function find($id);
    public function delete($id);
}