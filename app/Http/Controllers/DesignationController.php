<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        return view('designation');
    }

    public function store(Request $request)
    {
       /* $nom=$request->input('nom');
        $prix_p=$request->input('prix_p');
        $prix_g=$request->input('prix_g');
        $prix_std=$request->input('prix_std');
      */ 

    }

    public function update(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

    public function show(Request $request)
    {
        
    }
}
