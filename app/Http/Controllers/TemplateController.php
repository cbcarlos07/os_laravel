<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use DB;
class TemplateController extends Controller
{
    public function getListTemplate(){

        $template = Template::all();
        return response()->json( $template );

    }
}
