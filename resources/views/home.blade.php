@extends('layouts.app')

@section('content')

        <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Исследование канала</div>

                <div class="panel-body">
                    <div id="chart"></div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('computing') }}">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('step') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Шаг</label>

                                <div class="col-md-3">
                                    <input id="name" type="text" class="form-control input-sm" name="step"
                                           value="{{ old('step', 0.1) }}" >

                                    @if ($errors->has('step'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('step') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <h4>Геометрические параметры канала</h4>

                            <div class="form-group{{ $errors->has('L') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Длина, м</label>

                                <div class="col-md-6">
                                    <input id="L" type="text" class="form-control input-sm" name="L"
                                           value="{{ old('L') }}" >

                                    @if ($errors->has('L'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('L') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('W') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Ширина, м</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control input-sm" name="W"
                                           value="{{ old('W') }}" >

                                    @if ($errors->has('W'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('W') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('H') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Высота, м</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control input-sm" name="H"
                                           value="{{ old('H') }}">

                                    @if ($errors->has('H'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('H') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <h4>Режимные параметры</h4>

                            <div class="form-group{{ $errors->has('Vu') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Скорость движения крышки, м/с</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control input-sm" name="Vu"
                                           value="{{ old('Vu') }}" >

                                    @if ($errors->has('Vu'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Vu') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Tu') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-6 control-label">Температура, &deg;C</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control input-sm" name="Tu"
                                           value="{{ old('Tu') }}" >

                                    @if ($errors->has('Tu'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Tu') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <h4>Выбор материала</h4>
                            <select class="selectpicker" id="material_select" name="material_id">

                                @foreach($materials as $material)

                                    @if (old('material_id') == $material->id)
                                        <option value="{{$material->id}}" selected>{{$material->name}}</option>
                                    @else
                                        <option value="{{$material->id}}">{{$material->name}}</option>
                                    @endif

                                @endforeach

                            </select><hr>

                            <table id="parameters_table" class="table table-hover table-striped">

                                <tbody>


                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-4">
                            <table id="result_table" class="table table-hover table-striped small">
                                <thead>
                                <tr>
                                    <th>i</th>
                                    <th>T</th>
                                    <th>V</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($result as $r)
                                    <tr>
                                        <td>{{$r->i}}</td>
                                        <td>{{$r->T}}</td>
                                        <td>{{$r->V}}</td>
                                    </tr>
                                @endforeach



                                </tbody>
                            </table>

                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Исследовать
                                </button>
                            </div>
                        </div>

                    </div>




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var db;
    var app = {

        init:function () {
            var materialId = $("#material_select").val();
            utils.getMaterialParamsStart(materialId);


            $("#material_select").on('change',function (e) {

                utils.getMaterialParamsStart(this.value);

            });
        }
    };
    var utils = {
        getMaterialParamsStart:function (e) {

            $.ajax({
                    url: "api/get_material_parameters/"+e,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        if (data.status == "success") {
                            //alert(data.material.name);

                            $('#parameters_table tbody').hide("slow", function() {
                                $('#parameters_table tbody').remove();
                            });
                            $("#parameters_table").append("<tbody class='small'></tbody>");

                            if (typeof variable === 'undefined' || variable === null) {
                                console.log(data.material.parameters);
                                data.material.parameters.forEach(function(item, i, arr) {
                                    console.log( i + ": " + item.name );

                                    $("#parameters_table > tbody").hide().append("<tr><td>"+item.name+"</td><td>"+item.pivot.value+" "+item.unit+"</td></tr>").show('fast');

                                });
                            } else {
                                console.log('no material');


                            }


                        }


                    },
                    error: function(msg){
                        alert('Ошибка');
                    }

                }
            );


        }
    };
    $(function(){

        app.init();
    });

</script>
<!-- Latest compiled and minified JavaScript -->
<script src="/js/bootstrap-select.min.js"></script>
@endsection
<link rel="stylesheet" href="/css/bootstrap-select.min.css">