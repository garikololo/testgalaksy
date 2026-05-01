@extends('adminlte::page')

@section('content')
    <h1>Додати автобус</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('buses.store') }}">
        @csrf
        <input type="text" name="number"
               placeholder="Держ номер автобуса"
               class="form-control @error('number') is-invalid @enderror"
               value="{{ old('number') }}">

        @error('number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
            <option>Виберіть марку</option>
            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
        @error('brand_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button class="btn btn-success mt-2">Зберегти</button>
    </form>
@endsection