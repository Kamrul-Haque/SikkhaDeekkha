@extends('layouts.app')

@section('styles')
    <style>
        .row{
            padding-top: 200px;
        }
       .button{
           line-height: 200px;
           font-size: xx-large;
           font-weight: bolder;
           border-radius: 0;
           filter: drop-shadow(0px 5px 5px darkgray);
       }
       .green:hover{
           border-radius: 0;
           box-shadow: 5px 5px #38bf72;
       }
       .blue:hover{
           border-radius: 0;
           box-shadow: 5px 5px #348fdb;
       }
       .red:hover{
           border-radius: 0;
           box-shadow: 5px 5px #e13430;
       }
       .black:hover{
           border-radius: 0;
           box-shadow: 5px 5px #343a40;
       }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="">
                    <a href="{{ route('admin.institution.create') }}" class="btn btn-block btn-success green button">Create Institution</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <a href="{{ route('admin.institution.create') }}" class="btn btn-block btn-primary button blue">Create Subject</a>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-6">
                <div class="">
                    <a href="#" class="btn btn-block btn-danger red button">Create Institution</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <a href="#" class="btn btn-block btn-dark button black">Create Subject</a>
                </div>
            </div>
        </div>
    </div>
@endsection
