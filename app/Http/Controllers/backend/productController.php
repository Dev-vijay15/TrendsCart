<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Pest\Plugins\only;

class productController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return[
            new Middleware ('permission:read products', only : ['index']),
            new Middleware ('permission:edit products', only : ['edit']),
            new Middleware ('permission:create products', only : ['create']),
            new Middleware ('permission:delete products', only : ['destroy']),
        ];
    }

    public function index(){
        return view('backend.products.index');
    }

    public function create(){
        return view('backend.products.create');
    }
    
}
