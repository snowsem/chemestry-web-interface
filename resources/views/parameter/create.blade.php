@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Parameters / Create</div>

                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('parameters') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Наименование</label>

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

                            <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Единица измерения</label>

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

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Описание</label>

                                <div class="col-md-6">
                                    <textarea id="name" type="text" class="form-control" name="description" equired >{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Alias</label>

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




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить параметр
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
