<?php

namespace App\Http\Controllers\Edifygo_class;

use App\CLDashboardM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('edifygoclass/dashboard');
    }

    public function logout(request $request)
    {
    	$request->session()->flush();
        return redirect('/');
    }
}
