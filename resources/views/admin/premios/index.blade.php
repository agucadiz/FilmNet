<x-admin>

    <!-- Mensajes de éxito y error -->
    <div class="relative z-10">
        @if (session('success'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-success :status="session('success')" />
            </div>
        @endif

        @if (session('error'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-error :status="session('error')" />
            </div>
        @endif
    </div>

    <div class="min-h-screen flex justify-center items-center">
        <div class="overflow-x-auto max-w-screen-lg w-full mx-auto">
            <!-- Titulo -->
            <h1
                class="text-xl lg:text-3xl font-semibold mb-4 border border-gray-400 w-full pb-2 text-gray-700 bg-gray-100 p-3 rounded-lg text-center">
                Premios
            </h1>

            <div class="flex justify-center">
                <table class="text-sm text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <!-- Encabezados de la tabla -->
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-base sm:text-lg">
                                Nombre
                            </th>
                            <th scope="col"
                                class="py-3 px-6 text-center font-semibold text-base sm:text-lg hidden lg:table-cell">
                                Año
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-base sm:text-lg">
                                Audiovisual
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-base sm:text-lg">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <!-- Filas de la tabla -->
                    <tbody>
                        @foreach ($premios as $premio)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- Nombre premio -->
                                <td class="py-4 px-6 text-center text-base w-1/4">
                                    {{ $premio->nombre }}
                                </td>
                                <!-- Año premio -->
                                <td class="py-4 px-6 text-center text-base w-1/4 hidden lg:table-cell">
                                    {{ $premio->year }}
                                </td>
                                <td class="py-4 px-6 text-center text-base w-1/4">
                                    <a href="{{ route('audiovisual.show', ['audiovisual' => $premio->audiovisual]) }}"
                                        class="hover:text-gray-800">
                                        {{ $premio->audiovisual->titulo }}
                                    </a>
                                </td>
                                <!-- Acciones Premios -->
                                <td class="px-6 text-center w-1/4">
                                    <div class="flex justify-center lg:justify-start space-x-2">
                                        <!-- Botón para editar -->
                                        <a href="#" class="inline-block">
                                            <button
                                                class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 font-semibold text-xs sm:text-base"
                                                data-modal-target="EditarModal{{ $premio }}"
                                                data-modal-toggle="EditarModal{{ $premio }}">
                                                Editar
                                            </button>
                                        </a>

                                        <!-- Botón para borrar -->
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-xs sm:text-base"
                                            data-modal-target="popup-modal{{ $premio }}"
                                            data-modal-toggle="popup-modal{{ $premio }}">
                                            Borrar
                                        </button>
                                    </div>
                                </td>

                                <!-- Ventana modal para editar un premio -->
                                @include('admin.premios.edit')

                                <!-- Ventana modal para borrar un premio -->
                                @include('admin.premios.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                <!-- Botón insertar premio -->
                <a href="#" class="inline-block">
                    <button
                        class="px-4 py-2 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 mx-auto text-xs sm:text-base font-semibold"
                        data-modal-target="InsertarModal" data-modal-toggle="InsertarModal">
                        Insertar
                    </button>
                </a>

                <!-- Ventana modal para insertar una premio -->
                @include('admin.premios.create')
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $premios->links() }}
            </div>
        </div>
    </div>

</x-admin>
