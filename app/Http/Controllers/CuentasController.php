<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;
use Carbon\Carbon;
use App\Saldo;
use App\User;
use Illuminate\Support\Facades\Auth;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuentas::where('estatus',1)->where('usuario',Auth::user()->id)->get();
        //return $cuentas;
        return view('cuentas.index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombreCuenta = trim(strtoupper($request->input('nombreCuenta')));
        $montoInicial = trim($request->input('montoInicial'));

        $existe = Cuentas::where('nombre',$nombreCuenta)->where('estatus',1)->get();

        if(count($existe) > 0){

            return redirect()->route('cuentas.index')->with('registroFallido',"La cuenta ya existe en sistema");

        }else{

            $nuevaCuenta = new Cuentas;
            $nuevaCuenta->nombre = $nombreCuenta;
            $nuevaCuenta->monto_inicial = $montoInicial;
            $nuevaCuenta->fecha_creacion = Carbon::now();
            $nuevaCuenta->estatus = 1;
            $nuevaCuenta->usuario = Auth::user()->id;

            if($nuevaCuenta->save()){

                $nuevaCuentaSaldo = new Saldo;
                $nuevaCuentaSaldo->id_cuenta = $nuevaCuenta->id;
                $nuevaCuentaSaldo->saldo = $nuevaCuenta->monto_inicial;
                $nuevaCuentaSaldo->fecha_actualizacion = Carbon::now();
                $nuevaCuentaSaldo->id_usuario = Auth::user()->id;

                if($nuevaCuentaSaldo->save()){

                    return redirect()->route('cuentas.index')->with('registroCorrecto',"Se ha registrado correctamente tu nueva cuenta");    

                }else{

                    echo "fallo algo al crear el saldo";    

                }
            }else{

                echo "fallo algo al crear la cuenta";    

            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baja = Cuentas::where('id',$id)->update(['estatus' => 0]);
        if($baja){
                return redirect()->route('cuentas.index')->with('registroCorrecto',"Se ha eliminado correctamente tu cuenta");
        }else{
            echo "fallo algo ";    
        }
    }
}
