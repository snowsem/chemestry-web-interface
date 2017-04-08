<?php

namespace App\Http\Controllers;

use App\Parameter;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;

class ParameterController extends Controller
{
    public function index() {

        $model = Parameter::all();
        return view('parameter.index', ['parameters' => $model]);
    }

    public function create() {

        return view('parameter.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:parameters',
            'unit' => 'required|max:255',
            'alias' => 'required|max:255|unique:parameters',

        ]);

        if ($validator->fails()) {

            return redirect('parameters/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            try {

                $model = new Parameter();
                $model->name = $request->name;
                $model->unit = $request->unit;
                $model->description = $request->description;
                $model->alias = $request->alias;

                $model->save();

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully created parameter!');
                return Redirect::to('parameters');

            } catch (Exception $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('parameters/create')
                    ->withErrors($validator)
                    ->withInput();

            } catch (QueryException $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('parameters/create')
                    ->withErrors($validator)
                    ->withInput();

            }


        }
    }

    public function update(){

    }
    public function show(){

    }
}
