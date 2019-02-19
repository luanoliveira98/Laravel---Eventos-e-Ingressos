@extends('layouts.app')

@section('title', 'Uhuu | '. $event->name)

@section('content')
    <page-component size="12">

        <panel-component title="{{$event->name}}">
            <details-component
                image="../../../storage/{{$event->image}}"
                description="{{$event->description}}"
                v-bind:fields="{{json_encode([
                    ['key' => '1', 'name' => 'Data Inicial', 'value' => $event->date, 'col' => '3'],
                    ['key' => '2', 'name' => 'Data Final', 'value' => $event->date_end, 'col' => '3'],
                    ['key' => '3', 'name' => 'Horário Inicial', 'value' => $event->time, 'col' => '3'],
                    ['key' => '4', 'name' => 'Horário Final', 'value' => $event->time_end, 'col' => '3'],
                    ['key' => '5', 'name' => 'Local', 'value' => $event->place_name.', '.$event->place_city.' - '.$event->place_uf, 'col' => '12'],
                ])}}"
                tickets="yes"
                @guest
                    guest="disabled"
                @endguest
                @if (empty($lot))
                    sold="yes"                    
                @endif
            ></details-component>
        </panel-component>

        @if (!empty($lot))
            <modal-component name="add" title="Comprar Ingressos">
                <form-component id="formAdd" css="" action="{{route('ingressos.store')}}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="hidden" name="lots_id" value="{{$lot->id}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="half_entranceAdd">Tipo</label>
                            <select name="half_entrance" id="half_entranceAdd" class="form-control">
                                <option value="N">Valor Integral R$ {{number_format($lot->price, 2, ',', '.')}} 
                                    (+R$ {{number_format($lot->price*0.05, 2, ',', '.')}} taxa)</option>
                                @if ($lot->half_entrance == 'S')
                                    <option value="S">Meia-entrada R$ {{number_format($lot->price/2, 2, ',', '.')}} 
                                        (+R$ {{number_format($lot->price*0.025, 2, ',', '.')}} taxa)</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="quantifyAdd">Quantidade</label>
                            
                            @if (($lot->tickets - $lot->quantify) < $event->max_tickets_order)
                                <input type="number" name="quantify" id="quantifyAdd" class="form-control" placeholder="{{$lot->tickets - $lot->quantify}}" 
                                value="{{old('quantify')}}" max="{{$lot->tickets - $lot->quantify}}">
                            @else
                                <input type="number" name="quantify" id="quantifyAdd" class="form-control" placeholder="{{$event->max_tickets_order}}" 
                                value="{{old('quantify')}}" max="{{$event->max_tickets_order}}">
                            @endif
                        </div>
                    </div>
                </form-component>
                <span slot="buttons">
                    <button class="btn btn-info" form="formAdd">Comprar</button>
                </span>
            </modal-component>
        @endif
            
        @guest
            <modal-component name="login" title="Login necessário">
                <div>
                    <p>Para comprar ingressos é preciso realizar login. <a href="{{route('login')}}">Clique aqui</a>!</p>
                    <p>Caso não possua uma conta registre uma <a href="{{route('register')}}">clicando aqui</a>! É fácil e rápido!</p>   
                </div>
            </modal-component>
        @endguest            
@endsection
