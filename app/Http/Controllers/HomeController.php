<?php

namespace App\Http\Controllers;
use App\Material;
use App\Modules;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   //->only*('methods')
        //$this->middleware(['auth', 'admin']);
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processing = new Modules\ProcessingModule();
        $processing->W = 0.17;
        $processing->H = 0.009;
        $processing->L = 6.6;
        $processing->ro = 890;
        $processing->c = 2300;
        $processing->T0 = 200;//175
        $processing->Vu = 0.9;
        $processing->Tu = 200;
        $processing->m0 = 1550;
        $processing->b = 0.015;
        $processing->Tr = 180;
        $processing->n = 0.4;
        $processing->au = 2000;
        //print '<pre>';
        $result = $processing->getJSONresult();
        //print '</pre>';
        //print $processing->Q();
        $materials = Material::all();

        return view('home', ['materials' => $materials, 'json_result' => $result,'result' => json_decode($result)]);
    }

    public function computing(Request $request) {

        $validator = Validator::make($request->all(), [
            'step' => 'required|numeric|min:0',
            'L' => 'required|numeric|min:0',
            'W' => 'required|numeric|min:0',
            'H' => 'required|numeric|min:0',
            'Vu' => 'required|numeric',
            'Tu' => 'required|numeric',

        ]);
        if ($validator->fails()) {

            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        } else {

        }


    }

    public function getMaterialParams($id) {
        $material = Material::find($id);

        return response()->json([
            'status' => 'success',
            'material' => $material,
            'parameters' => $material->parameters,
        ]);
    }
}
