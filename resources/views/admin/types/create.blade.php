@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  <h1>Crea Tipologia</h1>
                  <a href="{{ route('admin.types.index') }}" class="btn btn-info">
                        Torna indietro
                  </a>
            </div>
      </div>

      @include('partials.errors')

      <div class="row mb-4">
            <div class="col">
                  <form action="{{ route('admin.types.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                              <label for="name" class="form-label">Nome nuova tipologia *</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Inserisci il nome nuova tipologia..." required maxlength="64">
                        </div>

                        <p>I campi contrassegnati con * sono obbligatori</p>

                        <div>
                              <button type="submit" class="btn btn-success">
                                    Crea
                              </button>
                        </div>
                  </form>
            </div>
      </div>
</div>
@endsection