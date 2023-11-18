@extends('template.layouts.app')

@section('content')

{{--    <div class="container-fluid">--}}
{{--        <div class="page-header">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}

{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>--}}
{{--                        <li class="breadcrumb-item">Pages</li>--}}
{{--                        <li class="breadcrumb-item active">Sample Page</li>--}}
{{--                    </ol>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <x-posts :posts="$posts"/>

@endsection
