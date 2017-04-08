<?php

namespace App\Http\Controllers;

use App\Coefficient;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;

class CoefficientController extends Controller
{
    public function index() {
        $model = Coefficient::all();
        return view('coefficient.index', ['coefficients' => $model]);
    }

    public function create() {

        return view('coefficient.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:coefficients',
            'alias' => 'required|max:255',
            'value' => 'required|max:255',
            'unit' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect('coefficients/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            try {

                $model = new Material();
                $model->name = $request->name;
                $model->alias = $request->alias;
                $model->value = $request->value;
                $model->unit = $request->unit;
                $model->save();

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully created material!');
                return Redirect::to('coefficients');

            } catch (Exception $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('coefficients')
                    ->withErrors($validator)
                    ->withInput();

            } catch (QueryException $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('coefficients')
                    ->withErrors($validator)
                    ->withInput();

            }


        }
    }
}
