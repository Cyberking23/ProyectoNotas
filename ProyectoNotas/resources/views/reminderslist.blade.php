@extends('layouts.dashboard')
@section('content')
    <h1 class="font-bold text-xl text-indigo-600 mb-4">Próximos Recordatorios</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($reminders as $reminder)
            <div class="bg-white shadow-md rounded-lg p-4 flex flex-col gap-2 border border-indigo-100">
                <div class="flex items-center gap-2">
                    <i class='bx bx-bell text-indigo-500 text-2xl'></i>
                    <span class="font-semibold text-indigo-700">{{ $reminder->note->title }}</span>
                </div>
                <div class="text-zinc-600">
                    <i class='bx bx-time text-indigo-400'></i>
                    {{ \Carbon\Carbon::parse($reminder->remind_at)->format('d/m/Y H:i') }}
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-zinc-500">
                No tienes recordatorios próximos.
            </div>
        @endforelse
    </div>
@endsection