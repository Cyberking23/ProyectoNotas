@extends('layouts.dashboard')
@section('content')

    <form 
        action="{{ isset($category) ? route('category.update') : route('category.store') }}"
        method="post"
        class="space-y-5 p-6 bg-white rounded-lg">
        @csrf

        @if (isset($category))
            @method('PUT')
            <input type="" name="id" value="{{$category->id}}" hidden>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg shadow-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Título -->
        <h1 class="font-bold text-xl text-indigo-600">
            @if (isset($category))
                Editar Nota
            @else
                Crear Categoria
            @endif
        </h1>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-indigo-600">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Escribe un nombre">
        </div>

        <!-- Botón -->
        <button type="submit"
            class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
            @if (isset($category))
                Editar Nota
            @else
                Crear Categoria
            @endif
        </button>
    </form>
@endsection
