@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center py-3 text-uppercase fw-bolder fst-italic">Project Details</h1>

                <div class="mb-4 d-flex justify-content-center">
                    <div class="mx-1">
                        <a href="{{ route('admin.project.edit', ['project' => $project->id]) }}"
                            class="btn btn-warning fw-bolder text-uppercase">Edit <i
                                class="fa-solid fa-pen-to-square"></i></a>
                    </div>

                    <button type="submit"class="btn btn-danger fw-bolder text-uppercase" data-bs-toggle="modal"
                        data-bs-target="#modal_post_delete-{{ $project->id }}">Delete
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    @include('admin.project.delete_modal')
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card border-2 rounded-2">
                    <div class="cover_container d-flex justify-content-center">
                        @if ($project->logo === null)
                            <img src="{{ Vite::asset('resources/img/folder.png') }}" alt="folder"
                                class="card-img-top rounded-0 w-50">
                        @else
                            <img src="{{ asset('storage/' . $project->logo) }}" alt="cover_image"
                                class="card-img-top rounded-0 w-50">
                        @endif
                    </div>
                    <div class="card-body bg-dark text-white fst-italic rounded-bottom-2">
                        <h5 class="card-title text-uppercase fw-bolder">Nome Progetto: <span>{{ $project['name'] }}</span>
                        </h5>
                        <div class="py-2 fst-italic">Tipo:
                            {{ $project->type ? $project->type->name : 'Nessuna tipologia' }}
                        </div>

                        <div class="mb-2">
                            <span>Tecnologie:</span>
                            @forelse ($project->technologies as $technology)
                                #{{ $technology->name }}
                            @empty
                                Il progetto non ha tecnologie assegnate.
                            @endforelse
                        </div>

                        <div class="card-text"> Data Inizio: {{ $project['start_date'] }}</div>
                        <div class="card-text"> Data Fine: {{ $project['end_date'] }}</div>
                        <div class="card-text py-2"> Descrizione: {{ $project['description'] }}</div>
                        <div class="card-text">Slug: {{ $project['slug'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
