@extends('layouts.dashboard')
@section('content')

    <form 
        action="{{ route('reminders.store') }}"
        method="post"
        class="space-y-5 p-6 bg-white rounded-lg">
        @csrf

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg shadow-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="font-bold text-xl text-indigo-600">
            Crear Recordatorio
        </h1>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-indigo-600">Nota</label>
            <select name="note_id" class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg" required>
                <option value="">Selecciona una nota</option>
                @foreach($notes as $note)
                    <option value="{{ $note->id }}">{{ $note->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-indigo-600">Fecha y hora del recordatorio</label>
            <input type="datetime-local" name="remind_at"
                class="w-full px-4 py-2.5 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <button type="submit"
            class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
            Crear Recordatorio
        </button>
    </form>
@endsection