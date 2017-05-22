@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Исследование канала</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('coefficients') }}">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Геометрические параметры канала</h4>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Длина, м</label>

                                <div class="col-md-3">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Ширина, м</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Высота, м</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <h4>Выбор материала</h4>
                            <select class="selectpicker" id="material_select" name="material_id">
                                @foreach($materials as $material)
                                    <option value="{{$material->id}}">{{$material->name}}</option>
                                @endforeach

                            </select><hr>

                            <table id="parameters_table" class="table table-hover table-striped">

                                <tbody>
                                @foreach($materials as $material)
                                    <tr>
                                        <th scope="row">{{$material->id}}</th>
                                        <td>{{$material->name}}</td>


                                        <td><a class="btn btn-sm small btn-info" href="{{url('materials/'.$material->id)}}">Просмотр</a>  <button class="btn btn-sm small btn-danger btn-remove-item" value="{{$material->id}}" url="{{url('materials/'.$material->id)}}">X</button></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-3">

                            <h4>Режимные параметры</h4>

                            <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Скорость движения крышки, м/с</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="alias"
                                           value="{{ old('alias') }}" required>

                                    @if ($errors->has('alias'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('alias') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Температура, &deg;C</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="unit"
                                           value="{{ old('unit') }}" required>

                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>






                        </div>

                        <div class="col-md-4">
                            ss


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
                            $("#parameters_table").append("<tbody></tbody>");

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