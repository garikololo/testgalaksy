@extends('adminlte::page')

@section('title', 'Автобуси')

@section('content')
    <a href="{{ route('buses.create') }}" class="btn btn-primary mb-2">Додати автобус</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Держ номер автобуса</th>
            <th>Марка</th>
            <th>Дії</th>
        </tr>

        @foreach($buses as $bus)
            <tr>
                <td>{{ $bus->id }}</td>
                <td>{{ $bus->number }}</td>
                <td>{{ $bus->brand->name }}</td>
                <td>
                    <a href="{{ route('buses.edit', $bus) }}" class="btn btn-warning">Редагувати</a>

                    <form action="{{ route('buses.destroy', $bus) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection