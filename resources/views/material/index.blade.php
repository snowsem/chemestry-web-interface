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


                                    <td><a class="btn btn-sm small btn-info" href="{{url('materials/'.$material->id)}}">Просмотр</a>  <button class="btn btn-sm small btn-danger btn-remove-item" value="{{$material->id}}" url="{{url('materials/'.$material->id)}}">X</button></td>
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
                $.ajax({
                    headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        },
                    url: url,
                    type: "DELETE",

                    success:function(data){

                        if(data == 'error'){

                        }else{

                            tr.hide("slow", function() {
                                tr.remove();
                            });
                        }
                    },
                    error: function(data, errorThrown){
                        console.log(errorThrown);
                    }


                });
            });
        });


    </script>
@endsection
