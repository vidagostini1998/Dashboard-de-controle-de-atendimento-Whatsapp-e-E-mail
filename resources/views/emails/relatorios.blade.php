@extends('home')

@php
    if(isset($mes1)){

    }
    else{
        $mes1 = "";
        $filaTotal = "";
    }
@endphp

@push('chart')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartBar');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['{!!$mes1!!}'],
    datasets: [{
      label: [{{date("Y")}}],
      data: [{{$filaTotal}}],
      borderWidth: 1,
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      }
    }
  }
});
</script>
@endpush
@section('main')
<div class="container">
    <h3 class="text-center">Conversas por Mês da Fila {{$nomeFila->nome}}</h3>
    <div class="text-center mb-4">
      <a class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Voltar" href="{{route('email')}}"><i class="fa-regular fa-circle-left"></i></a>
    </div>
    <canvas id="chartBar" class="w-60 h-70"></canvas>
    <br><br>
</div>
@endsection
