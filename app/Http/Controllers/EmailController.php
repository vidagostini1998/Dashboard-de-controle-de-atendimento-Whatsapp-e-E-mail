<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all(['id','nome']);
        $dados = Registro::all();
        $tipos = Tipo::all();
        return view('email',compact('tipos','dados','tipos'));
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
         //DB::enableQueryLog();
         DB::connection('mysql2')->statement("SET lc_time_names = 'pt_BR'");
         $filaMes = DB::connection('mysql2')->table('registros')->select([DB::raw('DATE_FORMAT(dataQuantidade,"%b") AS mes'),DB::raw('COUNT(*) AS total')])->where('id_tipo','=',$id)->whereYear('dataQuantidade','=',date('Y'))->groupBy('mes')->get();
         //dd(DB::getQueryLog());
         $nomeFila = DB::connection('mysql2')->table('tipos')->where('id','=',$id)->first();
         
         foreach ($filaMes as $fila) {
             $mes[] = $fila->mes;
             $total[] = $fila->total;
         }
         if(isset($mes)){
            $mes1 = implode("','",$mes);
            $filaTotal = implode(',', $total);
            
            return view('/emails/relatorios', compact('filaTotal','mes1','nomeFila'));
            
         }else{
            return view('/emails/relatorios', compact('nomeFila'));
         }
         
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
