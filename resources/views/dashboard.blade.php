@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>

                    {{--                     <div class="text-center">
                        <a href="{{ route('admin.project.index') }}"
                            class="btn btn-danger d-inline-block my-3 fw-bolder text-uppercase">Show
                            Project</a>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.type.index') }}"
                            class="btn btn-danger d-inline-block my-3 fw-bolder text-uppercase">Show Type</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
