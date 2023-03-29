@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  @include('partials.success')

                  <h1>{{ $type->name }}</h1>
                  
                  <h6>Slug: {{ $type->slug }}</h6>

                  <h3>Progetti associati ({{ $type->projects()->count() }})</h3>
                  @if ($type->projects()->count() > 0)
                        <ul>
                              @foreach ($type->projects as $project)
                                    <li>
                                          <a href="{{ route('admin.projects.show', $project->id) }}">
                                                {{ $project->title }}
                                          </a>
                                    </li>
                              @endforeach
                        </ul>
                  @else
                        <h4>Nessun progetto associato</h4>
                  @endif

                  <a href="{{ route('admin.types.index') }}" class="btn btn-info">
                        Torna indietro
                  </a>
            </div>
      </div>
</div>
@endsection