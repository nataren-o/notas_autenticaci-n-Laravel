@extends('layouts.app')

@section('content')
<form action="">
<a href="/notas" class="btn btn-primary btn-sm">Volver a lista de notas...</a>
<h1>Detalle de Nota:</h1>
<h4>ID: {{$nota->id}}</h4>
<h4>Nombre: {{$nota->nombre}}</h4>
<h4>Descripcion: {{$nota->descripcion}}</h4>
            <td>
    <a href="{{url('/notas/'.$nota->id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a>
    
            </td>

</form>

@endsection