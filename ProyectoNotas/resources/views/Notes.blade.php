@extends('layouts.dashboard')
@section('content')
    <div class="max-w-6xl">
        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de bienvenida -->
        <div class="bg-blue-100 text-blue-700 p-4 rounded-lg mb-6">
            <p class="text-lg font-semibold">¡Bienvenido, {{ Auth::user()->first_name }}!</p>
        </div>

        <div class="flex flex-col gap-4">
            @foreach ($notes as $note)
                <!-- Card Container -->
                <div
                    class="relative bg-white rounded-xl p-6 border border-indigo-100 hover:border-indigo-200 transition-colors">
                    <!-- Importance Badge -->
                    @if ($note->is_important)
                        <div class="absolute top-4 right-4 flex items-center space-x-1 text-indigo-600">
                            <i class='bx bxs-star text-xl'></i>
                        </div>
                    @endif

                    <!-- Card Header -->
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-indigo-900 mb-2">{{ $note->title }}</h3>
                        <div class="inline-flex items-center space-x-2">
                            <span class="px-2 py-1 rounded-md bg-indigo-50 text-indigo-600 text-sm font-medium">
                                {{ $note->tipo }}
                            </span>
                            <span class="text-sm text-indigo-400">
                                {{ $note->created_at->format('M d') }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <p class="text-indigo-600 leading-relaxed line-clamp-3">
                            {{ $note->content }}
                        </p>
                    </div>

                    <!-- Card Footer -->
                    <div class="flex items-center justify-between border-t border-indigo-100 pt-4">
                        <!-- Category -->
                        <div class="flex items-center space-x-2">
                            <i class='bx bx-category text-indigo-400'></i>
                            <span class="text-sm text-indigo-600 font-medium">
                                {{ $note->category->name ?? 'Sin categoría' }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <a href="/notes/{{ $note->id }}">
                                <button class="text-indigo-400 hover:text-indigo-600 transition-colors">
                                    <i class='bx bx-edit-alt text-xl'></i>
                                </button>
                            </a>
                            <button onclick="toggleModal('deleteModal{{ $note->id }}')"
                                class="text-indigo-400 hover:text-red-500 transition-colors">
                                <i class='bx bx-trash text-xl'></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="deleteModal{{ $note->id }}"
                    class="hidden fixed inset-0 z-[9999] bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <!-- Contenido del Modal -->
                        <div class="mt-3 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <i class='bx bx-trash text-red-600 text-xl'></i>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Eliminar Nota</h3>
                            <div class="mt-2 px-7 py-3">
                                <p class="text-sm text-gray-500">
                                    ¿Estás seguro de que quieres eliminar esta nota?
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="toggleModal('deleteModal{{ $note->id }}')"
                                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 mr-2">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <script>
                function toggleModal(modalId) {
                    const modal = document.getElementById(modalId);
                    modal.classList.toggle('hidden');

                    // Cerrar modal al hacer clic fuera del contenido
                    window.onclick = function(event) {
                        if (event.target === modal) {
                            modal.classList.add('hidden');
                        }
                    }
                }
            </script>
        </div>

    </div>
@endsection
