@extends('adminlte::page')

@section('title', 'Водії')

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Ім`я</th>
            <th>Прізвище</th>
            <th>Дата народження</th>
        </tr>

        @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->first_name }}</td>
                <td>{{ $driver->last_name }}</td>
                <td>{{ $driver->birth_date }}</td>
            </tr>
        @endforeach
    </table>
@endsection