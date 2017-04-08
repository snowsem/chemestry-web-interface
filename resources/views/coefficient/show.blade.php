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

                                    <table class="table">
                                        <thead>
                                        <tr>

                                            <th>Плотность, кг/м3</th>
                                            <th>Удельная теплоемкость, Дж/(кг * 0C)</th>
                                            <th>Температура плавления, 0С</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td>{{$material->ro}}</td>
                                                <td>{{$material->c}}</td>
                                                <td>{{$material->t0}}</td>

                                            </tr>


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
