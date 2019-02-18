@extends('layouts.app')

@section('title', 'Uhuu | Dashboard - Lista de Usuários')

@section('content')
    <page-component size="12">

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

        <panel-component title="Lista de Eventos">
            <crumbs-component v-bind:list="{{$listCrumbs}}"></crumbs-component>
            <table-list-component 
                v-bind:titles="['#','Name', 'E-mail']"
                v-bind:items="{{json_encode($listModel)}}"
                order ="asc" orderCol="1"
                create="#create" detail="/dashboard/eventos" edit="/dashboard/eventos/" deleted="/dashboard/eventos/" token="{{ csrf_token() }}"
                modal="yes"
            ></table-list-component>
            <div align="center">
                {{$listModel}}
            </div>
        </panel-component>
    </page-component>

    <modal-component name="add" title="Novo Evento">
        <form-component id="formAdd" css="" action="{{route('eventos.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
            <div class="row">
                <div class="form-group col-12">
                    <label for="nameAdd">Nome</label>
                    <input type="text" name="name" id="nameAdd" class="form-control" placeholder="Nome" value="{{old('name')}}">
                </div>
                <div class="form-group col-12">
                    <label for="descriptionAdd">Descrição</label>
                    <textarea name="description" id="descriptionAdd" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="form-group col-12">
                    <label for="max_tickets_orderAdd">Límite Máximo de Ingressos por Pedido</label>
                    <input type="number" name="max_tickets_order" id="max_tickets_orderAdd" class="form-control"  placeholder="10" value="{{old('max_tickets_order')}}" min="0">
                </div>
                <div class="form-group col-6">
                    <label for="dateAdd">Data Inicial</label>
                    <input type="date" name="date" id="dateAdd" class="form-control" value="{{old('date')}}" min="{{date('Y-m-d')}}">
                </div>
                <div class="form-group col-6">
                    <label for="date_endAdd">Data Final</label>
                    <input type="date" name="date_end" id="date_endAdd" class="form-control" value="{{old('date_end')}}" min="{{date('Y-m-d')}}">
                </div>
                <div class="form-group col-6">
                    <label for="timeAdd">Horário Inicial</label>
                    <input type="time" name="time" id="timeAdd" class="form-control" value="{{old('time')}}">
                </div>
                <div class="form-group col-6">
                    <label for="time_endAdd">Horário Final</label>
                    <input type="time" name="time_end" id="time_endAdd" class="form-control" value="{{old('time_end')}}">
                </div>
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formAdd">Add</button>
        </span>
    </modal-component>
    
    <modal-component name="edit" title="Editar Evento">
        <form-component id="formEdit" css="" v-bind:action="'/dashboard/eventos/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nameEdit">Nome</label>
                <input type="text" name="name" id="nameEdit" v-model="$store.state.item.name" class="form-control" placeholder="Nome">
            </div>
            <div class="form-group col-12">
                <label for="descriptionEdit">Descrição</label>
                <textarea name="description" id="descriptionEdit" v-model="$store.state.item.description" class="form-control"></textarea>
            </div>
            <div class="form-group col-12">
                <label for="max_tickets_orderEdit">Límite Máximo de Ingressos por Pedido</label>
                <input type="number" name="max_tickets_order" id="max_tickets_orderEdit" v-model="$store.state.item.max_tickets_order"  class="form-control"  placeholder="10" min="0">
            </div>
            <div class="form-group col-6">
                <label for="dateEdit">Data Inicial</label>
                <input type="date" name="date" id="dateEdit" v-model="$store.state.item.date"  class="form-control"min="{{date('Y-m-d')}}">
            </div>
            <div class="form-group col-6">
                <label for="date_endEdit">Data Final</label>
                <input type="date" name="date_end" id="date_endEdit" v-model="$store.state.item.date_end"  class="form-control" min="{{date('Y-m-d')}}">
            </div>
            <div class="form-group col-6">
                <label for="timeEdit">Horário Inicial</label>
                <input type="time" name="time" id="timeEdit" v-model="$store.state.item.time"  class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="time_endEdit">Horário Final</label>
                <input type="time" name="time_end" id="time_endEdit" v-model="$store.state.item.time_end"  class="form-control">
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formEdit">Edit</button>
        </span>
    </modal-component>
@endsection
