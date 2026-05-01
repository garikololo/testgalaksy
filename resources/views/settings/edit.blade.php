@extends('adminlte::page')

@section('content')
    <h3>Налаштування АТП</h3>
    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name"
               class="form-control"
               placeholder="Назва АТП"
               value="{{ $settings->name ?? '' }}">

        <input type="text" name="phone"
               class="form-control mt-2"
               placeholder="Телефон"
               value="{{ $settings->phone ?? '' }}">

        <textarea name="description"
                  class="form-control mt-2"
                  placeholder="Опис">{{ $settings->description ?? '' }}</textarea>

        <input type="file" name="logo" class="form-control mt-2">

        @if(!empty($settings->logo))
            <img src="{{ asset('storage/'.$settings->logo) }}" width="120" class="mt-2">
        @endif

        <button class="btn btn-success mt-3">
            Зберегти
        </button>
    </form>
@endsection