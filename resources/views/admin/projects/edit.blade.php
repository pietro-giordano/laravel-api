@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  <h1>Modifica Progetto</h1>
                  <a href="{{ route('admin.projects.index') }}" class="btn btn-info">
                        Torna indietro
                  </a>
            </div>
      </div>

      @include('partials.errors')

      <div class="row mb-4">
            <div class="col">
                  <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @method('PUT')

                        <div class="mb-3">
                              <label for="title" class="form-label">Titolo *</label>
                              <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" placeholder="Inserisci il titolo del progetto..." required maxlength="128">
                        </div>

                        <div class="mb-3">
                              <label for="type_id" class="form-label">Tipologia</label>
                              <select class="form-select" name="type_id" id="type_id">
                                    <option value="">Nessuna tipologia</option>
                                    @foreach ($types as $type)
                                          <option value="{{ $type->id }}"  {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                              </select>
                        </div>

                        <div class="mb-3">
                              <label class="form-label d-block mb-2">Tecnologia</label>
                              @foreach ($technologies as $technology)
                                    <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}" 
                                          @if (old('technologies') && is_array(old('technologies')) && count(old('technologies')) > 0)
                                                {{ in_array($technology->id, old('technologies')) ? 'checked' : '' }} 
                                          @elseif($project->technologies->contains($technology)) 
                                                checked
                                          @endif
                                          value="{{ $technology->id }}">
                                          <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                                    </div>
                              @endforeach
                        </div>
                        
                        <div class="mb-3">
                              <label for="description" class="form-label">Descrizione *</label>
                              <textarea class="form-control" id="description" name="description" placeholder="Inserisci descrizione del progetto..." rows="10" required maxlength="4096">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                              <label for="image" class="form-label">Immagine in evidenza</label>

                              @if ($project->image)
                                    <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="delete_check" id="delete_check">
                                          <label class="form-check-label" for="delete_check">
                                                Cancella immagine in evidenza
                                          </label>
                                    </div>

                                    <div>
                                          <img class="mb-3 w-50" src="{{ asset('storage/'.$project->image) }}" alt="">
                                    </div>
                              @endif

                              <input class="form-control" type="file" id="image" name="image">
                        </div>

                        <p>I campi contrassegnati con * sono obbligatori</p>

                        <div>
                              <button type="submit" class="btn btn-warning">
                                    Modifica
                              </button>
                        </div>
                  </form>
            </div>
      </div>
</div>
@endsection