<?php

namespace App\Http\Controllers\Backend;


class DashboardController extends BackendController
{
    public String $routePrefix = "dashbaord";
    
    public function index()
    {
        $view_name = "admin";

        $msg = "Comming Soon";

        $this->setForView(compact("view_name", "msg"));

        return $this->view($view_name);
    }
}
