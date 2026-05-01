@extends('adminlte::page')

@section('title', 'Brands')

@section('content')
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-2">Додати марку</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Дії</th>
        </tr>

        @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>
                    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-warning">Редагувати</a>

                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection