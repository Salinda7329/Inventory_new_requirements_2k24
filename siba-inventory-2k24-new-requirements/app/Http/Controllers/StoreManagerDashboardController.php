<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreManagerDashboardController extends Controller
{
      public function index() {
        return view('storeManager.store-manager-home');
      }
}
