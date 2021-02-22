<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class SaldosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldos = DB::TABLE('tbFinanzas_saldo')
                ->JOIN('tbFinanzas_cuentas','tbFinanzas_saldo.id_cuenta','=','tbFinanzas_cuentas.id')
                ->SELECT('tbFinanzas_saldo.id','tbFinanzas_cuentas.nombre','tbFinanzas_cuentas.monto_inicial','tbFinanzas_saldo.saldo','tbFinanzas_saldo.fecha_actualizacion','tbFinanzas_cuentas.estatus','tbfinanzas_saldo.id_usuario')
                ->WHERE('tbFinanzas_cuentas.estatus',1)
                ->WHERE('tbfinanzas_saldo.id_usuario',Auth::user()->id)
                ->GET();                
        return view('saldos.index',compact('saldos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nombreCuenta = DB::TABLE('tbfinanzas_saldo')
                        ->JOIN('tbFinanzas_cuentas','tbfinanzas_saldo.id_cuenta','=','tbFinanzas_cuentas.id')
                        ->SELECT('tbFinanzas_cuentas.nombre','tbfinanzas_saldo.saldo','tbFinanzas_cuentas.id','tbFinanzas_cuentas.monto_inicial')
                        ->WHERE('tbfinanzas_saldo.id',$id)
                        ->WHERE('tbfinanzas_saldo.id_usuario',Auth::user()->id)
                        ->GET();
        
        $movimientosIngreso = DB::TABLE('tbFinanzas_movimientos')
                            ->select('tbFinanzas_movimientos.descripcion','tbFinanzas_movimientos.monto','tbFinanzas_movimientos.fecha_creacion_mov')
                            ->join('tbfinanzas_saldo','tbFinanzas_movimientos.id_cuenta','tbfinanzas_saldo.id_cuenta')
                            ->where('tbFinanzas_movimientos.id_cuenta',$nombreCuenta[0]->id)
                            ->where('tbFinanzas_movimientos.tipo','I')
                            ->get();

        $movimientosEgreso = DB::TABLE('tbFinanzas_movimientos')
                            ->select('tbFinanzas_movimientos.descripcion','tbFinanzas_movimientos.monto','tbFinanzas_movimientos.fecha_creacion_mov')
                            ->join('tbfinanzas_saldo','tbFinanzas_movimientos.id_cuenta','tbfinanzas_saldo.id_cuenta')
                            ->where('tbFinanzas_movimientos.id_cuenta',$nombreCuenta[0]->id)
                            ->where('tbFinanzas_movimientos.tipo','E')
                            ->get();

        $movimientosIngresoTotal = DB::table('tbFinanzas_movimientos')        
                            ->where('tbFinanzas_movimientos.tipo','I')
                            ->where('tbFinanzas_movimientos.id_cuenta',$nombreCuenta[0]->id)
                            ->sum('tbFinanzas_movimientos.monto');

        $movimientosEgresoTotal = DB::table('tbFinanzas_movimientos')        
                            ->where('tbFinanzas_movimientos.tipo','E')
                            ->where('tbFinanzas_movimientos.id_cuenta',$nombreCuenta[0]->id)
                            ->sum('tbFinanzas_movimientos.monto');                            
                                                                               

        return view('saldos.show',compact('nombreCuenta','movimientosIngreso','movimientosEgreso','movimientosIngresoTotal','movimientosEgresoTotal'));
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
