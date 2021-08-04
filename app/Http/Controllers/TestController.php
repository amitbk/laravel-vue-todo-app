<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api');
  }

  public function index()
  {
      return "done";
  }
}
