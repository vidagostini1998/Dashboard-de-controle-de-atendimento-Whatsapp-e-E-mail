@extends('home')
@push('scripts1')
<meta http-equiv="refresh" content="10">
@endpush
@section('main')
<div class="pb-4 border-top">
    <h4 class="text-center mt-2">Tickets</h4>
    <div class="d-flex justify-content-center border-bottom mb-3">

        <div class="col-2">
            <div class="border rounded bg-info text-white text-center m-2 p-2">
                <h5 class="">Em Aberto</h5>
                <span class="badge">
                    <h5>{{$ticketsAbertos}} <i class="fa-regular fa-envelope-open"></i></h5>
                </span>
            </div>
        </div>
        <div class="col-2">
            <div class="border rounded bg-warning text-white text-center m-2 p-2">
                <h5 class="">Em Espera</h5>
                <span class="badge">
                    <h5>{{$ticketsPendentes}} <i class="fa-regular fa-clock"></i></h5>
                </span>
            </div>
        </div>
        <div class="col-2">
            <div class="border rounded bg-success text-white text-center m-2 p-2">
                <h5 class="">Finalizados</h5>
                <span class="badge">
                    <h5>{{$ticketsFinalizados}} <i class="fa-solid fa-xmark"></i></h5>
                </span>
            </div>
        </div>
    </div>
    <h3 class="text-center">Conversas por Fila em Aberto</h3>
    <div class=" row d-flex justify-content-center border-bottom mb-3 p-2">
        @foreach ($filas as $fila)
        <div class="col-3 m-1">
            <a class="text-decoration-none" href="{{route('whatsapp.rel.filas',$fila->id)}}">
                <div class="border rounded bg-info text-white text-center p-1">
                    <h5 class="">{{$fila->name}}</h5>
                    <span class="badge">
                        @php
                        $count1 =
                        DB::table('tickets')->where('queueId','=',$fila->id)->where('status','=','open')->count();
                        @endphp
                        <h5>{{$count1}} <i class="fa-regular fa-comment"></i></h5>
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <h3 class="text-center">Conversas por Atendente em Aberto</h3>
    <div class=" row d-flex justify-content-center">
        @foreach ($atendentes as $atendente)
        <div class="col-2">
            <a class="text-decoration-none" href="{{route('whatsapp.rel.users',$atendente->id)}}">
                <div class="border rounded bg-info text-white text-center p-1">
                    <h5 class="">{{$atendente->name}}</h5>
                    <span class="badge">
                        @php
                        $count =
                        DB::table('tickets')->where('userId','=',$atendente->id)->where('status','=','open')->count();
                        @endphp
                        <h5>{{$count}} <i class="fa-regular fa-comment"></i></h5>
                    </span>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection
