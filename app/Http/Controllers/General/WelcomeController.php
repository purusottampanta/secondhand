<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
   function __construct()
   {
   		
   }

   public function index()
   {
   		return view('welcome');
   }
}
