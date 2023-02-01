@extends('home')

@push('scripts1')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endpush

@push('form')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {$("#table").DataTable({info: !1,responsive: !0,order: [[1, 'asc']],lengthMenu: [[10, 25, 50, -1],[10, 25, 50, "Todos"]],columnDefs: [{className: "dt-center","targets": '_all'}],language: {lengthMenu: "_MENU_ Itens",zeroRecords: "Não encontrado",info: "Pagina _PAGE_ de _PAGES_",infoEmpty: "Não Existe Itens",search: "Busca:",infoFiltered: "(Filtrado de _MAX_ Itens)",paginate: {first: "Primeiro",last: "Ultimo",next: "Proximo",previous: "Anterior"}},dom: "Bftpl",})
    $("#table2").DataTable({info: !1,responsive: !0,lengthMenu: [[10, 25, 50, -1],[10, 25, 50, "Todos"]],columnDefs: [{className: "dt-center","targets": '_all'}],language: {lengthMenu: "_MENU_ Itens",zeroRecords: "Não encontrado",info: "Pagina _PAGE_ de _PAGES_",infoEmpty: "Não Existe Itens",search: "Busca:",infoFiltered: "(Filtrado de _MAX_ Itens)",paginate: {first: "Primeiro",last: "Ultimo",next: "Proximo",previous: "Anterior"}},dom: "Bftpl",})});
</script>
<script>
    function adc_tipo() {let form = document.getElementById('form_adc_tipo');form.submit();}
    function adc_dados() {let form = document.getElementById('form_adc_dados');form.submit();}
</script>
@endpush

@section('main')
<div class="text-center">
    <button class="btn btn-success m-1" data-bs-toggle="modal" data-bs-target="#adcModaldados">Adicionar Dados <i
            class="fa-solid fa-plus"></i></button>
    <button class="btn btn-success m-1" data-bs-toggle="modal" data-bs-target="#adcModalTipo">Adicionar Tipo de E-Mail
        Entrante <i class="fa-solid fa-plus"></i></button>
    <button class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#editModaldados">Excluir Dados/Tipos <i
            class="fa-regular fa-trash-can"></i></button>
</div>
<div class="border-top pb-4">
    <h4 class="text-center mt-2">Metricas E-Mail contato@iapat.com.br (Total Até {{date('m/Y')}})</h4>
    <div class=" row d-flex justify-content-center border-bottom mb-3 p-2">
        @foreach ($tipos as $tipo)
        <div class="col-3 m-1">
            <a class="text-decoration-none" href="{{route('email.rel',$tipo->id)}}">
                <div class="border rounded bg-info text-white text-center p-1">
                    <h5 class="">{{$tipo->nome}}</h5>
                    <span class="badge">
                        @php
                        $count1 =
                        DB::connection('mysql2')->table('registros')->where('id_tipo','=',$tipo->id)->sum('quantidade');
                        @endphp
                        <h5>{{$count1}} <i class="fa-regular fa-comment"></i></h5>
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Adicionar Tipo de E-Mail --}}
<div class="modal fade" id="adcModalTipo" tabindex="-1" aria-labelledby="adcModalTipoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Tipo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('email.adc.tipo')}}" method="POST" id="form_adc_tipo">
                    @csrf
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control" id="nome" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_tipo()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Adicionar Dados --}}
<div class="modal modal-lg fade" id="adcModaldados" tabindex="-1" aria-labelledby="adcModalDadosLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Dados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('email.adc.dado')}}" method="POST" id="form_adc_dados">
                    @csrf
                    <div class="mb-2">
                        <div class="form-floating">
                            <select name="id_tipo" id="id_tipo" class="form-select" required>
                                <option value="">Selecione</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                @endforeach
                            </select>
                            <label for="id_tipo" class="form-label">Tipo</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="date" name="dataQuantidade" class="form-control" id="dataQuantidade" required>
                            <label for="dataQuantidade" class="form-label">Data do Registro</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="number" name="quantidade" min="0" class="form-control" id="quantidade"
                                required>
                            <label for="quantidade" class="form-label">Quantidade</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_dados()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar/Excluir Dados --}}
<div class="modal modal-lg fade" id="editModaldados" tabindex="-1" aria-labelledby="editModalDadosLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Dados/Tipos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-dados-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-dados" type="button" role="tab" aria-controls="nav-dados"
                            aria-selected="true">Dados</button>
                        <button class="nav-link" id="nav-tipos-tab" data-bs-toggle="tab" data-bs-target="#nav-tipos"
                            type="button" role="tab" aria-controls="nav-tipos" aria-selected="false">Tipos</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-dados" role="tabpanel"
                        aria-labelledby="nav-dados-tab" tabindex="0">
                        <div class="table-responsive text-center">
                            <table class="styled-table text-center table-sm" id="table">
                                <thead>
                                    <tr>
                                        <th>Data Quantidade</th>
                                        <th>Tipo</th>
                                        <th>Quantidade</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dados as $dado)
                                    <tr>
                                        <td>{{date('m/Y',strtotime($dado->dataQuantidade))}}</td>
                                        <td>{{$dado->tipo->nome}}</td>
                                        <td>{{$dado->quantidade}}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="Editar" class="btn btn-warning m-1"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="Excluir" class="btn btn-danger m-1"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tipos" role="tabpanel" aria-labelledby="nav-tipos-tab"
                        tabindex="0">
                        <table class="styled-table text-center table-sm" id="table2">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipos as $tipo)
                                <tr>
                                    <td>{{$tipo->nome}}</td>
                                    <td>
                                        <a href="{{route('email.edit.tipo',$tipo->id)}}" data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-title="Editar" class="btn btn-warning m-1"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="{{route('email.del.tipo',$tipo->id)}}" data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-title="Excluir" class="btn btn-danger m-1"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@endsection
