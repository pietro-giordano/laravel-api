@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  <h1>Tipologie</h1>
                  <a href="{{ route('admin.types.create') }}" class="btn btn-success">
                        Aggiungi tipologia
                  </a>
            </div>
      </div>

      @include('partials.success')

      <div class="row">
            @foreach ($types as $type)
            <div class="col-3 mb-3">
                  <div class="card" style="width: 18rem;">
                        <div class="card-body">
                              <h3 class="card-title">#{{ $type->id }} {{ $type->name }}</h3>
                              <h6 class="card-subtitle mb-2 text-muted">{{ $type->slug }}</h6>
                              <h5 class="card-text">Facenti parte: {{ $type->projects()->count() }}</h5>

                              <a href="{{ route('admin.types.show', $type->id) }}" class="btn btn-info">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                              </a>

                              <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                              </a>

                              <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare tipologia?')">
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