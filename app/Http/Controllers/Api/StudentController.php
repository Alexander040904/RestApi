<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(){
        return 'index';
    }
    public function store(){
        return 'store';

    }
    public function show($id){
        return 'index'.$id;

    }
    public function update($id){
        return 'update'.$id;

    }
    public function destroy($id){
        return 'destroy'.$id;

    }
}
