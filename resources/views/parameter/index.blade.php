@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Parameters</div>

                    <div class="panel-body">
                        <a href="{{url('parameters/create')}}" class="btn btn-primary btn-sm pull-left">Добвать параметр</a>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Наименование</th>
                                <th>Единица измерения</th>
                                <th>Описание</th>
                                <th>Alias</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parameters as $parameter)
                                <tr>
                                    <th scope="row">{{$parameter->id}}</th>
                                    <td>{{$parameter->name}}</td>
                                    <td>{{$parameter->unit}}</td>
                                    <td>{{$parameter->description}}</td>
                                    <td>{{$parameter->alias}}</td>
                                    <td><button class="btn btn-sm btn-danger btn-remove-item" value="{{$parameter->id}}" url="{{url('parameters/'.$parameter->id)}}">X</button></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('button.btn-remove-item').on('click', function(e) {
                var url = $(this).attr("url");
                var value = $(this).attr("value");
                var tr = $(this).parent().parent();
                function success(e) {
                    //alert(e);
                    tr.hide("slow", function() {
                        tr.remove();
                    });
                }

                $.ajax({
                    headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        },
                    url: url,
                    type: "DELETE",
                    success: success(e),

                });
            });
        });


    </script>
@endsection
