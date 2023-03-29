@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  <h1>Tecnologie</h1>
                  <a href="{{ route('admin.technologies.create') }}" class="btn btn-success">
                        Aggiungi tecnologia
                  </a>
            </div>
      </div>

      @include('partials.success')

      <div class="row">
            @foreach ($technologies as $technology)
            <div class="col-3 mb-3">
                  <div class="card" style="width: 18rem;">
                        <div class="card-body">
                              <h3 class="card-title">#{{ $technology->id }} {{ $technology->name }}</h3>
                              <h6 class="card-subtitle mb-2 text-muted">{{ $technology->slug }}</h6>
                              {{-- <h5 class="card-text">Facenti parte: {{ $technology->projects()->count() }}</h5> --}}

                              <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-info">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                              </a>

                              <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                              </a>

                              <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare tipologia?')">
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