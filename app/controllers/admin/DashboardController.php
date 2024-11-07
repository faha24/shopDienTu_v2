<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\ICrud;
use App\Models\Details;


class DashboardController extends BaseController
{



    public function __construct()
    {

    }

    public function index()
    {
        $this->render('admin.home');
    }
    
  
}
