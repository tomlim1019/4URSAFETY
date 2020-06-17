@extends('layouts.app')

@section('content')
<div class="container">
    <div class="myContainer">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <P class="text-center">Please call our customer service @ 013-3834188</P>
                </div>
                <div class="text-center mb-2">
                    <a href="{{ route('login') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .myContainer{
        width: 98%;
        padding: 55px 25px 25px 27px;
        margin-left:55px;
    }

    .card{
        position: relative;
        border-radius: 0.25rem;
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    }

    .card-header{
        background-color: #0C2340;
        color:white;
        opacity:0.85;
    }
</style>
@endsection
