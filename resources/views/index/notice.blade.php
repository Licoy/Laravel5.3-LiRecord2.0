@extends('layouts.app')
@section('title'){{ $data->title }} - 公告@endsection
@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-volume-up"></i>&nbsp;{{ $data->title }}</div>
                    <div class="panel-body">
                        <div style="font-size: 20px;text-indent: 2em;font-weight: 100">{!! $data->text !!}</div>
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection