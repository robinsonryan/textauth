@extends('layouts.blank')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Credit Report Authorization</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => '/messages', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Borrower First Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Borrower 10-digit Mobile Number</label>
                            <div class="col-md-6">
                                <input type="phone" class="form-control"
                                       name="phone"
                                       value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Request Authorization
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection