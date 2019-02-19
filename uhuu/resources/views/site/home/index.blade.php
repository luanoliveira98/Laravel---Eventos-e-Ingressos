@extends('layouts.app')

@section('title', 'Uhuu')
@section('content')
    <page-component size="12">
        <panel-component title="Eventos">

            <p>
                <form action="{{route('home')}}" class="form-inline text-center" method="get">
                    <input type="search" name="search" id="search" placeholder="Buscar" class="form-control" value="{{isset($search) ? $search : ""}}">
                    <button class="btn btn-info">Buscar</button>
                </form>
            </p>

            <div class="row">
                @foreach ($list as $event)
                    <event-card-component
                        title="{{str_limit($event->name,25,"...")}}"
                        description="{{str_limit($event->description, 40,"...")}}"
                        link="{{route('eventos',[$event->id, str_slug($event->name)])}}"
                        image="storage/{{$event->image}}"
                        date="{{$event->date}}"
                        date_end="{{$event->date_end}}"
                        time="{{$event->time}} - {{$event->time_end}}"
                        organization="{{$event->organization}}"
                        place="{{$event->place_name}}, {{$event->place_city}} - {{$event->place_uf}}"
                        sm="6"  md="4">
                    </event-card-component>
                @endforeach
            </div>
            <div align="center">
                {{$list}}
            </div>
        </panel-component>
    </page-component>
@endsection
