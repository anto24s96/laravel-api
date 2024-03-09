@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-0 mt-3">
                <h1 class="text-uppercase">all projects</h1>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <p><i>you can add, view, modify and delete</i></p>
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center my-2">
                <p><strong>Create yours: </strong></p>
                <a class="my_button" href="{{ route('admin.project.create') }}">
                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                </a>
            </div>
        </div>
        {{-- TABLE --}}
        <div class="col-12">
            <table class="table table-striped my-table-style">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>
                                <a class="my_button me-1" href="{{ route('admin.project.show', ['project' => $project->id]) }}">
                                    <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                </a>

                                <a class="my_button me-1" href="{{ route('admin.project.edit', ['project' => $project->id]) }}">
                                    <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                                </a>

                                <button type="submit"class="my_button me-1" data-bs-toggle="modal" data-bs-target="#modal_post_delete-{{ $project->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.project.delete_modal')
@endsection

{{-- <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="py-3 fw-bolder">PROJECTS</h1>
                <div class="pt-3">
                    <a href="{{ route('admin.project.create') }}"
                        class="btn btn-outline-danger text-uppercase fw-bolder d-inline-block">add new
                        project <i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($projects as $project)
            <div class="col-3 py-5">
                <div class="card my-card rounded-2">
                    <div class="card_top">
                        <div class="cover_container">
                            @if ($project->logo === null)
                                <img src="{{ Vite::asset('resources/img/folder.png') }}" alt="folder"
                                    class="card-img-top">
                            @else
                                <img src="{{ asset('storage/' . $project->logo) }}" alt="cover_image"
                                    class="card-img-top">
                            @endif
                        </div>
                    </div>
                    <div class="card-body text-white text-center bg-dark rounded-bottom-2">
                        <h5 class="card-title text-center text-uppercase fw-bolder">
                            {{ $project['name'] }}
                        </h5>
                        <div class="py-2 fst-italic">Tipo:
                            {{ $project->type ? $project->type->name : 'Nessuna tipologia' }}
                        </div>
                        <div class="card-text">Data Inizio: {{ $project['start_date'] }}</div>
                        <div class="card-text">Data Fine: {{ $project['end_date'] }}</div>
                        <a href="{{ route('admin.project.show', ['project' => $project->id]) }}"
                            class="d-inline-block py-3 fw-bolder text-warning fs-5 text-decoration-none">DETAILS</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}
