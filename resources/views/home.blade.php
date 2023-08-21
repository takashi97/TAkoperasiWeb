@extends('layouts.navbar')

@section('content')
<link href="{{ asset('/css/mainpage.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome,  ') }}{{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        window.location.href = "/";
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
@endsection
