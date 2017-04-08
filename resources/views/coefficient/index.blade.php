@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <a href="{{url('coefficients/create')}}">Добвать коэффициент</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Наименование</th>
                                <th>alias</th>
                                <th>Значение</th>
                                <th>Ед. измерения</th>
                                <th>Действия</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coefficients as $coefficient)
                                <tr>
                                    <th scope="row">{{$coefficient->id}}</th>
                                    <td>{{$coefficient->name}}</td>
                                    <td>{{$coefficient->alias}}</td>p,,k<td>{{$coefficient->value}}</td>
                                    <td>{{$coefficient->unit}}</td>
                                    <td><a href="{{url('coefficients/'.$coefficient->id)}}">Редактировать</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
