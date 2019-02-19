@extends('layouts.app')

@section('title', 'Uhuu | Dashboard - Lista de Eventos')

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
                v-bind:titles="['#','Nome', 'Data']"
                v-bind:items="{{json_encode($listModel)}}"
                order ="asc" orderCol="1"
                create="#create" detail="/dashboard/eventos/detail" edit="/dashboard/eventos/" deleted="/dashboard/eventos/" token="{{ csrf_token() }}"
                modal="yes"
            ></table-list-component>
            <div align="center">
                {{$listModel}}
            </div>
        </panel-component>
    </page-component>

    <modal-component name="add" title="Novo Evento">
        <form-component id="formAdd" css="" action="{{route('eventos.store')}}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="row">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="imageAdd" value="{{old('image')}}">
                    <label class="custom-file-label" for="imageAdd">Escolha uma imagem</label>
                </div>
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
                <div class="form-group col-12">
                    <label for="place_nameAdd">Endereço</label>
                    <input type="text" name="place_name" id="place_nameAdd" class="form-control" value="{{old('place_name')}}">
                </div>
                <div class="form-group col-6">
                    <label for="place_cityAdd">Cidade</label>
                    <input type="text" name="place_city" id="place_cityAdd" class="form-control" value="{{old('place_city')}}">
                </div>
                <div class="form-group col-6">
                    <label for="place_ufAdd">Estado</label>
                    <select name="place_uf" id="place_ufAdd" class="form-control">
                        <option value="AC" {{ (collect(old('place_uf'))->contains("AC")) ? 'selected':'' }}>Acre</option>
                        <option value="AL" {{ (collect(old('place_uf'))->contains("AL")) ? 'selected':'' }}>Alagoas</option>
                        <option value="AP" {{ (collect(old('place_uf'))->contains("AP")) ? 'selected':'' }}>Amapá</option>
                        <option value="AM" {{ (collect(old('place_uf'))->contains("AM")) ? 'selected':'' }}>Amazonas</option>
                        <option value="BA" {{ (collect(old('place_uf'))->contains("BA")) ? 'selected':'' }}>Bahia</option>
                        <option value="CE" {{ (collect(old('place_uf'))->contains("CE")) ? 'selected':'' }}>Ceará</option>
                        <option value="DF" {{ (collect(old('place_uf'))->contains("DF")) ? 'selected':'' }}>Distrito Federal</option>
                        <option value="ES" {{ (collect(old('place_uf'))->contains("ES")) ? 'selected':'' }}>Espírito Santo</option>
                        <option value="GO" {{ (collect(old('place_uf'))->contains("GO")) ? 'selected':'' }}>Goiás</option>
                        <option value="MA" {{ (collect(old('place_uf'))->contains("MA")) ? 'selected':'' }}>Maranhão</option>
                        <option value="MT" {{ (collect(old('place_uf'))->contains("MT")) ? 'selected':'' }}>Mato Grosso</option>
                        <option value="MS" {{ (collect(old('place_uf'))->contains("MS")) ? 'selected':'' }}>Mato Grosso do Sul</option>
                        <option value="MG" {{ (collect(old('place_uf'))->contains("MG")) ? 'selected':'' }}>Minas Gerais</option>
                        <option value="PA" {{ (collect(old('place_uf'))->contains("PA")) ? 'selected':'' }}>Pará</option>
                        <option value="PB" {{ (collect(old('place_uf'))->contains("PB")) ? 'selected':'' }}>Paraíba</option>
                        <option value="PR" {{ (collect(old('place_uf'))->contains("PR")) ? 'selected':'' }}>Paraná</option>
                        <option value="PE" {{ (collect(old('place_uf'))->contains("PE")) ? 'selected':'' }}>Pernambuco</option>
                        <option value="PI" {{ (collect(old('place_uf'))->contains("PI")) ? 'selected':'' }}>Piauí</option>
                        <option value="RJ" {{ (collect(old('place_uf'))->contains("RJ")) ? 'selected':'' }}>Rio de Janeiro</option>
                        <option value="RN" {{ (collect(old('place_uf'))->contains("RN")) ? 'selected':'' }}>Rio Grande do Norte</option>
                        <option value="RS" {{ (collect(old('place_uf'))->contains("RS")) ? 'selected':'' }}>Rio Grande do Sul</option>
                        <option value="RO" {{ (collect(old('place_uf'))->contains("RO")) ? 'selected':'' }}>Rondônia</option>
                        <option value="RR" {{ (collect(old('place_uf'))->contains("RR")) ? 'selected':'' }}>Roraima</option>
                        <option value="SC" {{ (collect(old('place_uf'))->contains("SC")) ? 'selected':'' }}>Santa Catarina</option>
                        <option value="SP" {{ (collect(old('place_uf'))->contains("SP")) ? 'selected':'' }}>São Paulo</option>
                        <option value="SE" {{ (collect(old('place_uf'))->contains("SE")) ? 'selected':'' }}>Sergipe</option>
                        <option value="TO" {{ (collect(old('place_uf'))->contains("TO")) ? 'selected':'' }}>Tocantins</option>
                    </select>
                </div>
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formAdd">Add</button>
        </span>
    </modal-component>
    
    <modal-component name="edit" title="Editar Evento">
        <form-component id="formEdit" css="" v-bind:action="'/dashboard/eventos/'+$store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="row">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="imageEdit">
                    <label class="custom-file-label" for="imageEdit">Escolha uma imagem</label>
                </div>
                <div class="form-group col-12">
                    <label for="nameEdit">Nome</label>
                    <input type="text" name="name" id="nameEdit" v-model="$store.state.item.name" class="form-control" placeholder="Nome">
                </div>
                <div class="form-group col-12">
                    <label for="descriptionEdit">Descrição</label>
                    <textarea name="description" id="descriptionEdit" v-model="$store.state.item.description" class="form-control"></textarea>
                </div>
                <div class="form-group col-12">
                    <label for="max_tickets_orderEdit">Límite Máximo de Ingressos por Pedido</label>
                    <input type="number" name="max_tickets_order" id="max_tickets_orderEdit" v-model="$store.state.item.max_tickets_order" class="form-control"  placeholder="10" min="0">
                </div>
                <div class="form-group col-6">
                    <label for="dateEdit">Data Inicial</label>
                    <input type="date" name="date" id="dateEdit" v-model="$store.state.item.date" class="form-control" min="{{date('Y-m-d')}}">
                </div>
                <div class="form-group col-6">
                    <label for="date_endEdit">Data Final</label>
                    <input type="date" name="date_end" id="date_endEdit" v-model="$store.state.item.date_end" class="form-control" min="{{date('Y-m-d')}}">
                </div>
                <div class="form-group col-6">
                    <label for="timeEdit">Horário Inicial</label>
                    <input type="time" name="time" id="timeEdit" v-model="$store.state.item.time" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="time_endEdit">Horário Final</label>
                    <input type="time" name="time_end" id="time_endEdit" v-model="$store.state.item.time_end" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="place_nameEdit">Endereço</label>
                    <input type="text" name="place_name" id="place_nameEdit" v-model="$store.state.item.name" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="place_cityEdit">Cidade</label>
                    <input type="text" name="place_city" id="place_cityEdit" v-model="$store.state.item.place_city" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="place_ufEdit">Estado</label>
                    <select name="place_uf" id="place_ufEdit" class="form-control" v-model="$store.state.item.place_uf">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
        </form-component>
        <span slot="buttons">
            <button class="btn btn-info" form="formEdit">Edit</button>
        </span>
    </modal-component>
@endsection
