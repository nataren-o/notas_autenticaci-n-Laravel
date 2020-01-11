<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//se pone este modelo
use App\Nota;

class NotaController extends Controller
{
    /* este constructor sirve para proteger todas las url
    no dejará entrar si no se está logeado */
    public function __construct(){

    $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //con esto se accede al email
        $usuarioEmail =auth()->user()->email;
        //esto guardará el email del usuario logeado
        $notas =Nota::where ('usuario', $usuarioEmail)->paginate(5);
        return view('notas.lista', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //con esto se guarda
        $nota = new Nota();
        $nota->nombre = $request->nombre;
        $nota->descripcion = $request->descripcion;
        $nota->usuario = auth()->user()->email;
        $nota->save();
    
        return back()->with('mensaje', 'Nota Agregada!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota= Nota::findOrFail($id);
        return view ('notas.detalle',compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nota= Nota::findOrFail($id);
        return view('notas.editar', compact('nota'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //con esto se excluye el token
        $datosNotas=request()->except(['_token','_method']);
        //se se busca y se compara en la bases de datos y se actualiza todo loque encuentra $datosNotas
        Nota::where('id','=',$id)->update($datosNotas);
        //volver a retornar la misma vista con los datos actulizados
        $nota= Nota::findOrFail($id);
       return view('notas.editar', compact('nota'));
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notaEliminar =Nota::findOrFail($id);
        $notaEliminar -> delete();
        return back()->with ('mensaje', 'Nota Eliminada');
    }
}
