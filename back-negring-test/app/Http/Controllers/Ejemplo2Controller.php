<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ejemplo2Controller extends Controller
{
    public function index() { 
        error_log("aka");
        return 432578795; 
    } 
}
