<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Request; 

class Controller extends BaseController
{
    public function layer()
    {
    	return view('layer.master');
    }
}
