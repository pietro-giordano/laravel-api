@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  <h1>Progetti</h1>
                  <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                        Aggiungi progetto
                  </a>
            </div>
      </div>

      @include('partials.success')

      <div class="row">
            @foreach ($projects as $project)
            <div class="col-3 mb-3">
                  <div class="card" style="width: 18rem;">
                        <div class="card-body">
                              <h5 class="card-title">{{ $project->id }} {{ $project->title }}</h5>
                              <h6 class="card-subtitle mb-2 text-muted">{{ $project->slug }}</h6>
                              <h4 class="card-text">
                                    @if ($project->type)
                                          <a href="{{ route('admin.types.show', $project->type->id) }}">
                                                {{ $project->type->name }}
                                          </a>
                                    @else
                                          Nessuna tipologia
                                    @endif      
                              </h4>
                              <p class="card-text">{{ $project->description }}</p>

                              @if ($project->image)
                                    <div>
                                          <img class="card-img mb-3" src="{{ asset('storage/'.$project->image) }}" alt="">
                                    </div>
                              @endif

                              <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                              </a>

                              <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                              </a>

                              <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare il progetto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                          <i class="fa-solid fa-trash"></i>
                                    </button>
                              </form>
                        </div>
                  </div>
            </div>
            @endforeach
      </div>
</div>
@endsection