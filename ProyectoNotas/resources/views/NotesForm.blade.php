@extends('layouts.dashboard')
@section('content')

    <form 
        action="{{ isset($note) ? route('notes.update') : route('notes.create') }}"
        method="post"
        class="space-y-5 p-6 bg-white rounded-lg">
        @csrf

        @if (isset($note))
            @method('PUT')
            <input type="" name="id" value="{{$note->id}}" hidden>
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
            @if (isset($note))
                Editar Nota
            @else
                Crear Notas
            @endif
        </h1>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-indigo-600">Título</label>
            <input type="text" name="title" value="{{ old('title', $note->title ?? '') }}"
                class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Escribe un título">
        </div>

        <!-- Contenido -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-indigo-600">Contenido</label>
            <textarea rows="4" name="content"
                class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Escribe tu nota...">{{ old('content', $note->content ?? '') }}</textarea>
        </div>

        <!-- Fecha y Categoría -->
        <div class="grid gap-4 md:grid-cols-2">
            <!-- Fecha -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-indigo-600">Tipo</label>
                <input value="{{ old('tipo', $note->tipo ?? '') }}" name="tipo" placeholder="Tipo de la nota"
                    class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Categoría -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-indigo-600">Categoría</label>
                <select 
                    name="id_category"
                    class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">Sin Categoria</option>
                    @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center mt-4 space-x-3">
            <input 
            {{ old('is_important', $note->is_important ?? '') ? 'checked' : '' }} type="checkbox" id="important"
                value="1" name="is_important"
                class="w-4 h-4 text-indigo-600 border-indigo-300 rounded focus:ring-indigo-500">
            <label for="important" class="text-sm font-medium text-indigo-600">
                ¿Es importante?
            </label>
        </div>

        <!-- Botón -->
        <button type="submit"
            class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
            @if (isset($note))
                Editar Nota
            @else
                Crear Nota
            @endif
        </button>
    </form>
@endsection
