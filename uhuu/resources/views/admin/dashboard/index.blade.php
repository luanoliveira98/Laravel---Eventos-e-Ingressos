@extends('layouts.app')

@section('title', 'Uhuu | Dashboard')

@section('content')
<page-component size="11">
    <panel-component title="Dashboard">
        <crumbs-component v-bind:list="{{$listCrumbs}}"></crumbs-component>
        <div class="row">
            <div class="col-md-4">
                <box-component quantify="{{$countTables['events']}}" title="Eventos" url="{{route('eventos.index')}}" color="pink" icon="fas fa-calendar-alt"></box-component>
            </div>  
            @can('isAdmin')
            <div class="col-md-4">
                <box-component quantify="{{$countTables['users']}}" title="Usuários" url="{{route('usuarios.index')}}" color="DarkOrchid" icon="fas fa-users"></box-component>
            </div>
            <div class="col-md-4">
                <box-component quantify="{{$countTables['admins']}}" title="Administradores" url="{{route('administradores.index')}}" color="orchid" icon="fas fa-user-shield"></box-component>
            </div>
            @endcan
        </div>
    </panel-component>
</page-component>
@endsection
