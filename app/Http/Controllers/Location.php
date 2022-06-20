<?php

namespace App\Http\Controllers;

use App\LocationM;
use App\GenericM;
use Illuminate\Http\Request;

class Location extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/locations/country');
    }
}
