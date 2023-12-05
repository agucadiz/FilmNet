<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 mt-20 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Mis votaciones
    </h1>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if ($votaciones->isEmpty())
                <p class="text-center text-lg text-gray-500">No has realizado votaciones.</p>
            @else
                <table class="min-w-full divide-y divide-gray-100 text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900 tracking-wider">
                                Audiovisuales
                            </th>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900 tracking-wider">
                                Características
                            </th>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900 tracking-wider">
                                <div class="flex items-center justify-center">
                                    <span class="mr-2">Votos</span>
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full">
                                        {{ auth()->user()->votaciones->count() }}
                                    </span>
                                </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($votaciones as $votacion)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            <a
                                                href="{{ route('audiovisual.show', ['audiovisual' => $votacion->audiovisual]) }}">
                                                <img class="h-20 w-20 rounded-full"
                                                    src="{{ $votacion->audiovisual->img }}"
                                                    alt="{{ $votacion->audiovisual->titulo }}">
                                            </a>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-lg font-medium text-gray-900">
                                                <a href="{{ route('audiovisual.show', ['audiovisual' => $votacion->audiovisual]) }}"
                                                    class="hover:underline font-bold">
                                                    {{ $votacion->audiovisual->titulo }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg">
                                    Año: {{ $votacion->audiovisual->year }}<br>
                                    Duración: {{ $votacion->audiovisual->duracion }} minutos<br>
                                    País: {{ $votacion->audiovisual->pais }}<br>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-xl">
                                    {{ $votacion->voto }}
                                    <!-- Mostrar las estrellas (1 al 10) -->
                                    <div class="flex items-center justify-center mt-2">
                                        @for ($i = 1; $i <= 10; $i++)
                                            @if ($i <= $votacion->voto)
                                                <span class="text-yellow-300 text-2xl">&#9733;</span>
                                            @else
                                                <span class="text-gray-400 text-2xl">&#9733;</span>
                                            @endif
                                        @endfor
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="mx-6 mt-4 mb-10">
        {{ $votaciones->links() }}
    </div>
</x-app-layout>
