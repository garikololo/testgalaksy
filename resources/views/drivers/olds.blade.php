@extends('adminlte::page')

@section('title', 'Старі водії')

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Дії</th>
        </tr>

        @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->first_name }}</td>
                <td>
                    <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning">Редагувати</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection