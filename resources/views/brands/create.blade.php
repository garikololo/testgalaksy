@extends('adminlte::page')

@section('content')
    <h1>Додати марку</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('brands.store') }}">
        @csrf
        <input type="text" name="name"
               placeholder="Марка"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button class="btn btn-success mt-2">Зберегти</button>
    </form>
@endsection