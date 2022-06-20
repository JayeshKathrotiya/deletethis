<?php

namespace App\Http\Controllers\Edifygo_class;

use App\ClassM;
use App\GenericM;
use App\EdifygoM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EClass extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['class'] = ClassM::getClassData();
        $data['main_courses'] = GenericM::getAllData('tbl_main_course',array('isdelete' =>0,'status'=>1));
        return view('edifygoclass/class/create-class',$data);
    }

    public function createClass1()
    {
        return view('edifygoclass/class/create-class1');
    }

    public function createClass2()
    {
        return view('edifygoclass/class/create-class2');
    }

    public function filterClass()
    {
        return view('edifygoclass/class/filter-class');
    }
}
