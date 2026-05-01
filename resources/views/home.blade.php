<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Хочу стати водієм</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('driver.request.store') }}">
                        @csrf

                        <input type="text" name="first_name"
                               class="form-control"
                               placeholder="Імʼя">

                        <input type="text" name="last_name"
                               class="form-control mt-2"
                               placeholder="Прізвище">

                        <input type="date" name="birth_date"
                               class="form-control mt-2">

                        <button class="btn btn-success mt-3">
                            Відправити заявку
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


