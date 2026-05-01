@extends('adminlte::page')

@section('title', 'Водії')

@section('content')
    <a href="{{ route('drivers.create') }}" class="btn btn-primary mb-2">Додати водія</a>

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

                    <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection