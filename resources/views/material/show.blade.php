@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard / materials / {{$material->name}}</div>

                    <div class="panel-body">

                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основное</a></li>
                                <li role="presentation"><a href="#params" aria-controls="params" role="tab" data-toggle="tab">Параметры</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="main">
                                    <h3>Наименование: {{$material->name}}</h3>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="params">
                                    <br>
                                    <a href="{{url('materials/'.$material->id.'/create')}}" class="btn btn-default">Добавить параметр</a>

                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Наименование параметра</th>
                                            <th>Значение</th>
                                            <th>Ед. Измерения</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($material->parameters as $parameter)
                                            <tr>
                                                <!--{{$parameter}} !-->
                                                <td>{{$parameter->name}}</td>
                                                <td>{{$parameter->pivot->value}}</td>
                                                <td>{{$parameter->unit}}</td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
