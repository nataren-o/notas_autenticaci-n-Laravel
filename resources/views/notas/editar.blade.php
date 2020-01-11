@extends('layouts.app')

@section('content')
<h1>Editar Notas {{$nota->id}}</h1>


<!-- <form action="/notas/{nota}"method="POST">
<form action="/notas/{nota}"method="POST">
                    <form action=" {{url('/notas/'.$nota->id)}}"method="POST">
                    @method('PUT') 
    @method('PUT')-->
        <!-- esto sirve para generar un token de seguridad 
    @csrf-->
    <form action="{{ url('/notas/'.$nota->id) }}"method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Nota</span>
                    <a href="/notas" class="btn btn-primary btn-sm">Volver a lista de notas...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                    
                    <!-- esto sirve para generar un token de seguridad -->
                      @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2" value="{{ $nota->nombre }}"/>

                      <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripcion"
                      class="form-control mb-2"value="{{ $nota->descripcion }}"/>

                    <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </div>
   </form>

@endsection