@extends('layouts.app')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <a href="{{ route('editprofile') }}" >Change Password</a>
            </button>
        </div>
    </div>
    <img src="https://via.placeholder.com/150" class="rounded mx-auto d-block pb-4">

    <div class="row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->email }}</p>
        </div>
    </div>

    <div class="row">
        <label for="id_no" class="col-md-4 col-form-label text-md-right">{{ __('Identification No. (Mykad/Passport)') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->id_no }}</p>
        </div>
    </div>

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->name }}</p>
        </div>
    </div>

    <div class="row">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->gender }}</p>
        </div>
    </div>

    <div class="row">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->birthdate }}</p>
        </div>
    </div>

    <div class="row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->status }}</p>
        </div>
    </div>
</main>
@endsection