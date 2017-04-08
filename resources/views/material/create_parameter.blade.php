@extends('layouts.app')
<!-- Latest compiled and minified CSS -->
<script src="/js/jquery-lates-min.js"></script>


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard/ имя / Добавить параметр</div>

                    <div class="panel-body">
                        <form id="params_form" class="form-horizontal" role="form" method="POST" action="{{ url('materials/'.$id.'/create') }}">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-4">

                                    <select class="selectpicker" name="parameter_id">
                                        @foreach($parameters as $parameter)
                                            <option value="{{$parameter->id}}">{{$parameter->name}}, {{$parameter->unit}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                        <input id="name" type="text" class="form-control" name="value"
                                                   value="{{ old('value') }}" required>
                                        @if ($errors->has('value'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                            @endif

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить параметр
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$id}}"/>
                        </form>
                    </div>





                </div>
            </div>
        </div>
    </div>
@endsection
<link rel="stylesheet" href="/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="/js/bootstrap-select.min.js"></script>

