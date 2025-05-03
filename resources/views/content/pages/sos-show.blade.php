@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Actulizar Sistema operativo')

@section('content')
<div class="row">
    <div-col-lg-12>
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Actualizar Sistema operativo</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route ('pages-sos-update')}}">
            @csrf
          <input type="hidden" name="sos_id" value="{{$sos->id}}">
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nombre completo</label>
            <input type="text" name="name" value="{{$sos->name}}" class="form-control" id="basic-default-fullname" />
            <!-- el name del input es lo que va a mandar mediante el post, al laravel para leer la request de la variable -->
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Version</label>
            <input type="text" name="version" value="{{$sos->version}}" class="form-control" id="basic-default-email" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Email</label>
            <input type="text" name="description" value="{{$sos->description}}" class="form-control" id="basic-default-email" />
          </div>
        
        
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
    </div-col-lg-12>
</div>
@endsection