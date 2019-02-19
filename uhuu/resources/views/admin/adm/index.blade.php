@extends('layouts.app')

@section('title', 'Uhuu | Dashboard - Lista de Administradores')

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

        <panel-component title="Lista de Administradores">
            <crumbs-component v-bind:list="{{$listCrumbs}}"></crumbs-component>
            <table-list-component 
                v-bind:titles="['#','Nome', 'E-mail']"
                v-bind:items="{{json_encode($listModel)}}"
                order ="asc" orderCol="1"
                create="#create" edit="/dashboard/administradores/" deleted="/dashboard/administradores/" token="{{ csrf_token() }}"
                modal="yes"
            ></table-list-component>
            <div align="center">
                {{$listModel}}
            </div>
        </panel-component>
    </page-component>

    <modal-component name="add" title="Novo Administrador">
        <form-component id="formAdd" css="" action="{{route('administradores.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nameAdd">Nome</label>
                <input type="text" name="name" id="nameAdd" class="form-control" placeholder="Nome Completo" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="emailAdd">E-mail</label>
                <input type="email" name="email" id="emailAdd" class="form-control" placeholder="E-mail" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="adminAdd">Admin</label>
                <select name="admin" id="adminAdd" class="form-control">
                    <option value="S" {{(old('admin') && old('admin') == 'S' ? 'selected' : '')}}{{(!old('admin') ? 'selected' : '')}}>Sim</option>
                    <option value="N" {{(old('admin') && old('admin') == 'N' ? 'selected' : '')}}>Não</option>
                </select>
            </div>
            <div class="form-group">
                <label for="passwordAdd">Senha</label>
                <input type="password" name="password" id="passwordAdd" class="form-control" value="{{old('password')}}">
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formAdd">Add</button>
        </span>
    </modal-component>
    
    <modal-component name="edit" title="Editar Administrador">
        <form-component id="formEdit" css="" v-bind:action="'/dashboard/administradores/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nameEdit">Nome</label>
                <input type="text" name="name" id="nameEdit" v-model="$store.state.item.name" class="form-control" placeholder="Nome Completo">
            </div>
            <div class="form-group">
                <label for="emailEdit">E-mail</label>
                <input type="text" name="email" id="emailEdit" v-model="$store.state.item.email" class="form-control" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="adminEdit">Admin</label>
                <select name="admin" id="adminEdit" class="form-control" v-model="$store.state.item.admin" >
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </div>
            <div class="form-group">
                <label for="passwordEdit">Password</label>
                <input type="password" name="password" id="passwordEdit" class="form-control">
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formEdit">Edit</button>
        </span>
    </modal-component>
@endsection
