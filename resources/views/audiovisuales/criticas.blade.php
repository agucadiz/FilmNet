<x-app-layout>
    <!-- Encabezado de la página -->
    <h1 class="text-2xl font-bold mb-8 mt-20 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Críticas
    </h1>

    <!-- Sección de información del audiovisual -->
    <div class="mt-10 mb-10 mx-4 relative">
        <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual->id]) }}">
            <div class="max-w-4xl mx-auto relative">
                <!-- Imagen panorámica -->
                <img src="{{ $audiovisual->img }}" alt="{{ $audiovisual->titulo }}"
                    class="w-full h-48 object-cover object-center rounded-md shadow-md mb-8">

                <!-- Contenedor absoluto para el título y la nota media -->
                <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center text-white">
                    <!-- Nombre del audiovisual con fondo semi-transparente -->
                    <p class="text-3xl font-bold mb-4 bg-blue-500 bg-opacity-50 p-4 rounded-md">
                        {{ $audiovisual->titulo }}
                    </p>

                    <!-- Nota media del audiovisual con fondo semi-transparente -->
                    <p class="text-lg font-semibold mb-4 bg-blue-500 bg-opacity-50 p-2 rounded-md">
                        Nota Media: {{ number_format($notaMedia, 1) }}
                    </p>
                </div>
            </div>
        </a>
    </div>

    <!-- Sección para mostrar las críticas -->
    @forelse ($criticas as $critica)
        @php
            $votacion = $critica->audiovisual->obtenerVotacion($critica->user_id, $critica->audiovisual_id);
        @endphp

        <div class="flex justify-center mb-4">
            <!-- Contenedor principal de cada crítica -->
            <div class="bg-blue-500 p-2 max-w-4xl rounded-md shadow-md w-full">

                <!-- Primera fila (fila de arriba) -->
                <div class="flex items-center justify-between m-2 bg-gray-100 p-4 rounded-md">
                    <!-- Columna 1: Detalles del usuario y fecha -->
                    <div class="w-2/3 flex flex-col ml-4">
                        <div class="flex flex-col">
                            <!-- Autor de la crítica -->
                            <div class="font-medium mb-2 text-2xl flex items-center">
                                <!-- Icono de usuario -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="26" width="26"
                                    viewBox="0 0 512 512" class="mr-2">
                                    <path
                                        d="M256 288A144 144 0 1 0 256 0a144 144 0 1 0 0 288zm-94.7 32C72.2 320 0 392.2 0 481.3c0 17 13.8 30.7 30.7 30.7H481.3c17 0 30.7-13.8 30.7-30.7C512 392.2 439.8 320 350.7 320H161.3z" />
                                </svg>
                                {{ $critica->user->name }}

                                <!-- Información de ciudad y país -->
                                <span class="ml-2 text-base italic text-gray-900">
                                    {{ $critica->user->ciudad }} ({{ $critica->user->pais }})
                                </span>
                            </div>

                            <!-- Número de críticas y votaciones realizadas por el usuario -->
                            <div class="font-medium mb-2 text-lg flex items-center">
                                <span class="mr-2">
                                    {{ $critica->user->criticas->count() }} críticas
                                </span>
                                <span class="text-gray-500">|</span>
                                <span class="ml-2">
                                    {{ $critica->user->votaciones->count() }} votaciones
                                </span>
                            </div>

                            <!-- Fecha de la crítica -->
                            <div class="font-medium mb-2 text-lg flex items-center">
                                <!-- Icono de calendario -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                    viewBox="0 0 448 512" class="mr-2">
                                    <path
                                        d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                </svg>
                                {{ $critica->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Columna 2: Nota Usuario -->
                    <div class="w-1/3 flex justify-end items-center">
                        <div class="mt-2 flex space-x-4">
                            <!-- Nota del usuario al audiovisual -->
                            <p
                                class="font-bold {{ $votacion && $votacion->voto ? 'text-3xl text-white bg-blue-500 border border-blue-700 rounded-md p-3 mr-10 mb-4' : 'text-lg text-gray-500' }}">
                                @if ($votacion && $votacion->voto)
                                    {{ number_format($votacion->voto, 1) }}
                                @else
                                    El usuario no ha votado.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4 mx-2">

                <!-- Segunda fila (fila de abajo) -->
                <div class="bg-gray-100 p-4 rounded-md m-2">
                    <div class="text-lg font-bold mb-2">Crítica:</div>
                    <p class="text-lg" style="min-height: 6rem;">{{ $critica->critica }}</p>
                </div>

            </div>

            <!-- Línea divisoria entre críticas -->
            <hr class="my-4">
        </div>
    @empty
        <!-- Mensaje si no hay críticas -->
        <p class="text-lg text-center font-semibold">No hay críticas disponibles.</p>
    @endforelse
</x-app-layout>
