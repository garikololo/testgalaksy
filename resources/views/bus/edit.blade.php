@extends('adminlte::page')

@section('content')
    <h1>Редагувати автобус</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('buses.update', $bus) }}">
        @csrf
        @method('PUT')
        <input type="text" name="number"
               placeholder="Держ номер автобуса"
               class="form-control @error('number') is-invalid @enderror"
               value="{{ $bus->number }}">

        @error('number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
            <option>Виберіть марку</option>
            @foreach($brands as $item)
                <option value="{{$item->id}}" @if($item->id === $bus->brand_id) selected="selected" @endif>{{$item->name}}</option>
            @endforeach
        </select>
        @error('brand_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <button class="btn btn-success mt-2">Зберегти</button>
    </form>
    <h1>Редагувати водіїв автобуса</h1>
    <br>
    @foreach($bus->drivers as $driver)
        <div class="row mt-2 image-item">
            <div class="col">
                {{ $driver->first_name . ' ' . $driver->last_name }}
            </div>
            <div class="col">
                <form action="{{ route('buses.detachDriver', $bus->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="driver_id" value="{{$driver->id}}">

                    <button type="submit" class="btn btn-danger">
                        Видалити
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    <hr>
    <br>

    <form method="POST" action="{{ route('buses.attachDriver', $bus->id) }}">
        @csrf

        <select name="driver_id" class="form-control">
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">
                    {{ $driver->first_name . ' ' . $driver->last_name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-success mt-2">
            Прив’язати водія
        </button>
    </form>


@endsection