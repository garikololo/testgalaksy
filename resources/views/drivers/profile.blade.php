@extends('adminlte::page')

@section('content')

    <h3>Мій профіль</h3>

    <p><b>Імʼя:</b> {{ $driver->first_name }}</p>
    <p><b>Прізвище:</b> {{ $driver->last_name }}</p>

    <h4 class="mt-3">Мої автобуси</h4>

    <ul>
        @foreach($driver->busesUser as $bus)
            <li>
                {{ $bus->number }} ({{ $bus->brand->name ?? '' }})
            </li>
        @endforeach
    </ul>

@endsection