@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
      <div class="row justify-content-center mb-4">
            <div class="col">
                  @include('partials.success')

                  <h1>{{ $project->title }}</h1>
                  
                  <h6>Slug: {{ $project->slug }}</h6>

                  <h4>Tipologia: 
                        @if ($project->type)
                              <a href="{{ route('admin.types.show', $project->type->id) }}">
                                    {{ $project->type->name }}
                              </a>
                        @else
                              Nessuna tipologia
                        @endif
                  </h4>

                  <h4>Tecnologia: 
                        @if ($project->technologies)
                              <ul>
                                    @foreach ($project->technologies as $tech)
                                          <li>
                                                <a href="{{ route('admin.technologies.show', $tech->id) }}">
                                                      {{ $tech->name }}
                                                </a>
                                          </li>
                                    @endforeach
                              </ul>
                        @else
                              Nessuna tecnologia
                        @endif
                  </h4>

                  <p>{{ $project->description }}</p>

                  @if ($project->image)
                        <div>
                              <img class="mb-3 w-50" src="{{ asset('storage/'.$project->image) }}" alt="">
                        </div>
                  @endif

                  <a href="{{ route('admin.projects.index') }}" class="btn btn-info">
                        Torna indietro
                  </a>
            </div>
      </div>
</div>
@endsection