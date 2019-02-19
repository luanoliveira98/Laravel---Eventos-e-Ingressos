@extends('layouts.app')

@section('title', 'Uhuu | Dashboard - Lista de Lotes')

@section('content')
    <page-component size="12">

        <panel-component title="{{$event->name}}">
            <crumbs-component v-bind:list="{{$listCrumbs}}"></crumbs-component>

            <details-component
                image="../../../storage/{{$event->image}}"
                description="{{$event->description}}"
                v-bind:fields="{{json_encode([
                    ['key' => '0', 'name' => 'Total de Ingressos por Pedido', 'value' => $event->max_tickets_order, 'col' => '12'],
                    ['key' => '1', 'name' => 'Data Inicial', 'value' => $event->date, 'col' => '3'],
                    ['key' => '2', 'name' => 'Data Final', 'value' => $event->date_end, 'col' => '3'],
                    ['key' => '3', 'name' => 'Horário Inicial', 'value' => $event->time, 'col' => '3'],
                    ['key' => '4', 'name' => 'Horário Final', 'value' => $event->time_end, 'col' => '3'],
                    ['key' => '5', 'name' => 'Local', 'value' => $event->place_name.', '.$event->place_city.' - '.$event->place_uf, 'col' => '12'],
                ])}}"
                value="[]"
                col="[12,3,3,3,3,12]"
            ></details-component>

            <p class="h4">Lista de Lotes</p>
            @if($errors->all())
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $key => $value)
                    <li><strong>{{$value}}</strong></li>
                    @endforeach
                </div>
            @endif
            <table-list-component 
                v-bind:titles="['#','Preço', 'Total de Ingressos', 'Ingressos Vendidos']"
                v-bind:items="{{json_encode($listModel)}}"
                order ="asc" orderCol="1"
                create="#create" edit="/dashboard/lotes/" deleted="/dashboard/lotes/" token="{{ csrf_token() }}"
                modal="yes"
            ></table-list-component>
            <div align="center">
                {{$listModel}}
            </div>
        </panel-component>
    </page-component>

    <modal-component name="add" title="Novo Evento">
        <form-component id="formAdd" css="" action="{{route('lotes.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
            <div class="row">
                <div class="form-group col-12">
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                </div>
                <div class="form-group col-12">
                    <label for="priceAdd">Preço</label>
                    <input type="number" name="price" id="priceAdd" class="form-control" placeholder="R$ 10,00" value="{{old('price')}}">
                </div>
                <div class="form-group col-12">
                    <label for="ticketsAdd">Ingressos à Venda</label>
                    <input type="number" name="tickets" id="ticketsAdd" class="form-control" placeholder="100" value="{{old('tickets')}}">
                </div>
                <div class="form-group col-12">
                    <label for="half_entranceAdd">Meia-entrada</label>
                    <select name="half_entrance" id="half_entranceAdd" class="form-control">
                        <option value="N" {{(old('half_entrance') == 'N')? 'selected' : ''}}>Não</option>
                        <option value="S" {{(old('half_entrance') == 'S')? 'selected' : ''}}>Sim</option>
                    </select>
                </div>
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formAdd">Add</button>
        </span>
    </modal-component>
    
    <modal-component name="edit" title="Editar Evento">
        <form-component id="formEdit" css="" v-bind:action="'/dashboard/lotes/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="row">
                <div class="form-group col-12">
                    <label for="priceEdit">Preço</label>
                    <input type="number" name="price" id="priceEdit" class="form-control" v-model="$store.state.item.price" placeholder="R$ 10,00">
                </div>
                <div class="form-group col-12">
                    <label for="ticketsEdit">Ingressos à Venda</label>
                    <input type="number" name="tickets" id="ticketsEdit" class="form-control" v-model="$store.state.item.tickets" placeholder="100">
                </div>
                <div class="form-group col-12">
                    <label for="half_entranceEdit">Meia-entrada</label>
                    <select name="half_entrance" id="half_entranceEdit" v-model="$store.state.item.half_entrance" class="form-control">
                        <option value="N">Não</option>
                        <option value="S">Sim</option>
                    </select>
                </div>
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formEdit">Edit</button>
        </span>
    </modal-component>
@endsection
