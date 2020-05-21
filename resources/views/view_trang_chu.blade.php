@extends('layer.master')
@section('pageTitle', 'Quản lý khóa học')
@push('css')
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
            }

            .full-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
@endpush
@section('trang_chu')
	<div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Welcome
            </div>
        </div>
    </div>
@endsection