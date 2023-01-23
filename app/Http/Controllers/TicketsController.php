<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function whatsapp(){
        $ticketsAbertos = DB::table('tickets')->where('status','=','open')->count();
        $ticketsPendentes = DB::table('tickets')->where('status','=','pending')->count();
        $ticketsFinalizados = DB::table('tickets')->where('status','=','closed')->count();

        $atendentes = DB::table('users')->get(['id','name'])->whereNotIn('id','1');
        $filas = DB::table('queues')->orderBy('fila','asc')->get(['id','name']);
        
        return view('whatsapp',compact('ticketsAbertos','ticketsPendentes','ticketsFinalizados','atendentes','filas'));
    }

    public function relFilas($id){
        //DB::enableQueryLog();
        DB::statement("SET lc_time_names = 'pt_BR'");
        $filaMes = DB::table('tickets')->select([DB::raw('DATE_FORMAT(createdAt,"%b") AS mes'),DB::raw('COUNT(*) AS total')])->where(DB::raw('YEAR("createdAt")=YEAR(CURDATE())'))->where('queueId','=',$id)->groupBy('mes')->get();
        //dd(DB::getQueryLog());
        $nomeFila = DB::table('queues')->where('id','=',$id)->first();
        foreach ($filaMes as $fila) {
            $mes[] = $fila->mes;
            $total[] = $fila->total;
        }
        $mes1 = implode("','",$mes);
        $filaTotal = implode(',', $total);
        return view('/filas/relatorio', compact('filaTotal','mes1','nomeFila'));
    }

    public function relUsers($id){
        //DB::enableQueryLog();
        DB::statement("SET lc_time_names = 'pt_BR'");
        $ticketMes = DB::table('tickets')->select([DB::raw('DATE_FORMAT(createdAt,"%b") AS mes'),DB::raw('COUNT(*) AS total')])->where(DB::raw('YEAR("createdAt")=YEAR(CURDATE())'))->where('userId','=',$id)->groupBy('mes')->get();
        //dd(DB::getQueryLog());
        $nomeUser = DB::table('users')->where('id','=',$id)->first();
        foreach ($ticketMes as $ticket) {
            $mes[] = $ticket->mes;
            $total[] = $ticket->total;
        }
        $mes1 = implode("','",$mes);
        $ticketTotal = implode(',', $total);
        return view('/usuarios/relatorio', compact('ticketTotal','mes1','nomeUser'));
    }

}