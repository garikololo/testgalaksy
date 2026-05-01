<?php

use Carbon\Carbon;
?>


@extends('adminlte::page')

@section('content')
    <h1>Редагувати водія</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('drivers.update', $driver) }}">
        @csrf
        @method('PUT')
        <input type="text"
               name="first_name"
               class="form-control"
               placeholder="Ім'я"
               value="{{ $driver->first_name }}">
        @error('first_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <input type="text"
               name="last_name"
               class="form-control mt-2"
               placeholder="Прізвище"
               value="{{ $driver->last_name }}">

        @error('last_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <input type="date"
               name="birth_date"
               class="form-control mt-2"
               value="{{ Carbon::parse($driver->birth_date)->format('Y-m-d') }}">

        @error('birth_date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <input type="email"
               name="email"
               class="form-control mt-2"
               placeholder="Email"
               value="{{ $driver->email }}">

        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <input type="text"
               name="salary"
               class="form-control mt-2"
               placeholder="Зарплата"
               value="{{ $driver->salary }}">

        @error('salary')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <div id="image-wrapper" class="mt-3">
            @foreach($driver->image as $key => $image)
                <div class="row mt-2 image-item">
                    <div class="col">
                        <input type="text" name="image[{{$key}}][text]" value="{{$image['text']}}" class="form-control" placeholder="Текст">
                    </div>
                    <div class="col">
                        <input type="text" name="image[{{$key}}][src]" value="{{$image['src']}}" class="form-control" placeholder="URL">
                    </div>
                    <div class="col">
                        <button type="button" onclick="removeImage(this)" class="btn btn-danger">
                            Видалити
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div>
            <button type="button" class="btn btn-secondary mt-2" onclick="addImage()">
                + Додати зображення
            </button>
        </div>

        <div>
            <button type="submit" class="btn btn-success mt-3">
                Зберегти
            </button>
        </div>
    </form>

    <script>
        function addImage() {
            let wrapper = document.getElementById('image-wrapper');

            let index = wrapper.children.length;

            wrapper.innerHTML += `
        <div class="row mt-2 image-item">
            <div class="col">
                <input type="text" name="image[${index}][text]" class="form-control" placeholder="Текст">
            </div>
            <div class="col">
                <input type="text" name="image[${index}][src]" class="form-control" placeholder="URL">
            </div>
            <div class="col">
                <button type="button" onclick="removeImage(this)" class="btn btn-danger">
                    Видалити
                </button>
            </div>
        </div>
    `;
        }

        function removeImage(btn) {
            btn.closest('.image-item').remove();
        }
    </script>
@endsection