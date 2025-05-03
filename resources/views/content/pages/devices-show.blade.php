@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Actualizando equipo')
@section( 'vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
 @endsection

@section( 'vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
@endsection
 
@section('page-script')
<script src="{{asset('assets/js/forms-selects.js')}}"></script> 
<script src="{{asset('assets/js/forms-tagify.js')}}"></script> 
<script src="{{asset('assets/js/forms-typeahead.js')}}"></script> 
@endsection

@section('content')
<div class="row">
  <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif -->
    <div-col-lg-12>
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Actualizando</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route ('pages-devices-update')}}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="devices_id" value="{{$devices->id}}">
          <img src="{{$devices->image_url}}" alt="" style="width:20%">
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Imagen del dispositivo</label>
            <input type="file" name="fileLogo" class="form-control" id="basic-default-email"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="selectpickerIcons">Tipo de dispositivo</label>
            <select class="selectpicker w-100 show-tick" id="selectpickerIcons" data-icon-base="bx" data-tick-icon="bx-check" data-style="btn-default" name="type_id">
              @forelse($types as $type)
               <option value="{{$type->id}}" @if($type->id==$devices->type_id) selected @endif data-icon="bx bx-{{$type->icon}}">{{$type->name}}</option>

              @empty

              @endforelse
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="selectpickerIcons">Sistema operativo</label>
            <select class="selectpicker w-100 show-tick" id="selectpickerIcons" data-icon-base="bx" data-tick-icon="bx-check" data-style="btn-default" name="sos_id">
              @forelse($sos as $so)
               <option value="{{$so->id}}" @if($so->id==$devices->sos_id) selected @endif>{{$so->name}}</option>

              @empty

              @endforelse
            </select>
          </div>


          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nombre</label>
            <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Nombre" value="{{$devices->name}}" required/>
            <!-- el name del input es lo que va a mandar mediante el post, al laravel para leer la request de la variable -->
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Description</label>
            <input type="text" name="description" class="form-control" id="basic-default-email" placeholder="categoria monitores" value="{{$devices->description}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Numero de serie</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->serial_number}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Mac</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->mac_address}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Direccion ip</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->ip_address}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Modelo</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->model}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Fábrica</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->manufacturer}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Firmware</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->firmware}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Stock</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->stock}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Disco duro</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->hdd}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Memoria ram</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->ram}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">CPU</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->cpu}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Tarjeta grafica</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->gpu}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Slots totales</label>
            <input type="text" name="version" class="form-control" id="basic-default-fullname" value="{{$devices->total_slots}}"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Historico</label>
            <textarea type="text" name="version" class="form-control" id="exampleFormControlTextareal" rows="3" value="{{$devices->name}}"></textarea>
          </div>
        
        
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
    </div-col-lg-12>
</div>
@endsection