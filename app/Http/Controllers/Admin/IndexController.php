<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Establecimiento;

class IndexController extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
