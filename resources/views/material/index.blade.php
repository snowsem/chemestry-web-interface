@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Материалы </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{url('materials/create')}}" class="btn btn-primary btn-sm pull-left">Добвать материал</a>

                            </div>
                            <div class="col-lg-6">
                          </div>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Наименование</th>

                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $material)
                                <tr>
                                    <th scope="row">{{$material->id}}</th>
                                    <td>{{$material->name}}</td>

                                    <td><a href="{{url('materials/'.$material->id)}}">Просмотр</a></td>
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
