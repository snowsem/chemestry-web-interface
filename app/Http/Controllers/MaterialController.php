<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialParameter;
use App\Parameter;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;

class MaterialController extends Controller
{

    public function __construct()
    {   //->only*('methods')
        //$this->middleware(['auth', 'admin']);
        $this->middleware(['auth']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $model = Material::all();
        return view('material.index', ['materials' => $model]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {

        return view('material.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:materials',

        ]);

        if ($validator->fails()) {

            return redirect('materials/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            try {

                $model = new Material();
                $model->name = $request->name;
                $model->save();

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully created material!');
                return Redirect::to('materials');

            } catch (Exception $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('materials')
                    ->withErrors($validator)
                    ->withInput();

            } catch (QueryException $e) {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $e->getMessage());
                return redirect('materials')
                    ->withErrors($validator)
                    ->withInput();

            }
        }
    }


    public function show($id)
    {
        try {
            $model = Material::findOrFail($id);
            return view('material.show', ['material' => $model]);

        } catch (ModelNotFoundException $e) {

            Log::error($e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            //Session::flash('message', $e->getMessage());
            Session::flash('message', 'Запись не найдена');
            return redirect('materials');

        }

    }

    public function createParameter($id) {

        $material_parameeter_ids = MaterialParameter::select('parameter_id')->where('material_id', '=', $id)->get()->toArray();
        //var_dump($material_parameeter_ids);
        //dd($material_parameeter_ids);

        $parameter = Parameter::whereNotIn('id',$material_parameeter_ids)->get();
        return view('material.create_parameter', [
            'id' => $id,
            'parameters' => $parameter,
        ]);
    }
    public function storeParameter(Request $request, $id) {

        $material = Material::find($id);
        $parameter = Parameter::find($request->parameter_id);

        if ($material->parameters->contains($parameter)) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Параметр уже привязан');
            return redirect('materials/'.$id)
                ->withInput();

        } else {
            $validator = Validator::make($request->all(), [
                'parameter_id' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Не прошла валидация');
                return redirect('materials/' . $id . '/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $material->parameters()->save($parameter, ['value' => $request->value]);

                return redirect('materials/' . $id . '');
            }
        }
    }

    public function destroy($id){

        try {
            Material::findOrFail($id)->delete();
            return 'success';
        } catch (Exception $e) {

            return 'error';
        }
    }
}
