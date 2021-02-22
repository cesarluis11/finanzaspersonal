<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;
use App\Movimientos;
use App\Saldo;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;

class MovimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuentas::where('estatus',1)->where('usuario',Auth::user()->id)->get();
        $movimientos = DB::TABLE('tbFinanzas_movimientos')
                        ->JOIN('tbFinanzas_cuentas','tbFinanzas_movimientos.id_cuenta','=','tbFinanzas_cuentas.id')
                        ->SELECT('tbFinanzas_movimientos.id','tbFinanzas_movimientos.descripcion','tbFinanzas_movimientos.fecha_creacion_mov','tbFinanzas_movimientos.tipo','tbFinanzas_movimientos.monto','tbFinanzas_cuentas.nombre','tbFinanzas_movimientos.id_usuario')
                        ->WHERE('tbFinanzas_movimientos.id_usuario',Auth::user()->id)
                        ->GET();
        return view('movimientos.index',compact('cuentas','movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta = $request->input('cuenta');
        $tipo = $request->input('tipo');
        $descripcion = trim(strtoupper($request->input('descripcion')));
        $monto = $request->input('monto');

        if($tipo == "I"){

            $movimiento = new Movimientos();
            $movimiento->id_cuenta = $cuenta;
            $movimiento->descripcion = $descripcion;
            $movimiento->monto = $monto;
            $movimiento->tipo = $tipo;
            $movimiento->cargo = 0;
            $movimiento->abono = $monto;
            $movimiento->fecha_creacion_mov = Carbon::now();
            $movimiento->id_usuario = Auth::user()->id;

            if($movimiento->save()){

                $saldoCuenta = Saldo::select('saldo')->where('id_cuenta',$movimiento->id_cuenta)->get();
                $nuevoSaldo = (float)$saldoCuenta[0]->saldo + (float)$movimiento->monto;
                $updateSaldo = Saldo::where('id_cuenta',$movimiento->id_cuenta)->update(['saldo' => $nuevoSaldo]);

                if($updateSaldo){

                    return redirect()->route('movimientos.index')->with('registroCorrecto',"Se ha registrado correctamente tu movimiento");

                }else{

                    echo "algo salio mal al actualizar el saldo en saldo";

                }
            }else{

                echo "algo salio mal en crear tu nuevo movimiento";
            }
        }
        if($tipo == "E"){

            $movimiento = new Movimientos();
            $movimiento->id_cuenta = $cuenta;
            $movimiento->descripcion = $descripcion;
            $movimiento->monto = $monto;
            $movimiento->tipo = $tipo;
            $movimiento->cargo = $monto;
            $movimiento->abono = 0;
            $movimiento->fecha_creacion_mov = Carbon::now();
            $movimiento->id_usuario = Auth::user()->id;

            if($movimiento->save()){

                $saldoCuenta = Saldo::select('saldo')->where('id_cuenta',$movimiento->id_cuenta)->get();
                $nuevoSaldo = (float)$saldoCuenta[0]->saldo - (float)$movimiento->monto;
                $updateSaldo = Saldo::where('id_cuenta',$movimiento->id_cuenta)->update(['saldo' => $nuevoSaldo]);

                if($updateSaldo){

                    return redirect()->route('movimientos.index')->with('registroCorrecto',"Se ha registrado correctamente tu movimiento");

                }else{

                    echo "algo salio mal al actualizar el saldo en saldo";

                }
            }else{
                
                echo "error";
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
        //
    }
}
