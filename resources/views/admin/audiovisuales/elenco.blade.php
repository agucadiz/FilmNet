 <!-- Ventana modal para añadir un elenco -->
 <div id="ElencoModal{{ $audiovisual }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-7xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-gray-700">
                 <!-- Botón para cerrar la ventana modal -->
                 <button type="button"
                     class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                     data-modal-hide="ElencoModal{{ $audiovisual }}">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal body -->
             <form id="formularioEdit" action="{{ route('audiovisuales.updateBusqueda', $audiovisual) }}" method="POST"
                 class="max-w-7xl w-full" enctype="multipart/form-data">
                 @method('put')
                 @csrf

                 <div class="p-2 space-y-2">
                     <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">

                         <!-- COLUMNA 1 -->
                         <div>
                             <!-- Titulo y tipo del audiovisual -->
                             <div class="mb-2 md:mb-12 p-1 md:p-2">
                                 <div>
                                     <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual]) }}"
                                         class="text-gray-700 hover:text-gray-900 border-b-2 border-blue-500 block text-xl md:text-2xl font-bold dark:text-white mt-5">
                                         {{ $audiovisual->titulo }}
                                     </a>
                                     <div class="mt-3">

                                         <span class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                                             Tipo: {{ $audiovisual->tipo->nombre }}
                                         </span>
                                     </div>
                                 </div>
                             </div>

                             <!-- Nuevo campo de búsqueda para DIRECTOR -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Titulo -->
                                 <x-input-label for="search_director" :value="__('Director:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre del director si ya está asignado -->
                                 @if ($audiovisual->directores->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->directores->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre" class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún director asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_director{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_director" placeholder="Buscar director..." />

                                     <button type="button" onclick="buscarDirector('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="director{{ $audiovisual->id }}"
                                     name="director{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="directorResults{{ $audiovisual->id }}"
                                     class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para COMPOSITOR -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_compositor" :value="__('Compositor:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre del compositor si ya está asignado -->
                                 @if ($audiovisual->compositores->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->compositores->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre" class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún compositor asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_compositor{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_compositor" placeholder="Buscar compositor..." />

                                     <button type="button" onclick="buscarCompositor('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="compositor{{ $audiovisual->id }}"
                                     name="compositor{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="compositorResults{{ $audiovisual->id }}"
                                    class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para FOTOGRAFÍA -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_fotografia" :value="__('Fotografía:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre del director de fotografía si ya está asignado -->
                                 @if ($audiovisual->fotografias->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->fotografias->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre" class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún director de fotografía asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_fotografia{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_fotografia" placeholder="Buscar fotografía..." />

                                     <button type="button" onclick="buscarFotografia('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="fotografia{{ $audiovisual->id }}"
                                     name="fotografia{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="fotografiaResults{{ $audiovisual->id }}"
                                    class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>
                         </div>

                         <!-- COLUMNA 2 -->
                         <div>
                             <!-- Nuevo campo de búsqueda para GUIONISTAS -->
                             <div class="md:mt-3 mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_guionista" :value="__('Guionista:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre del guionista si ya está asignado -->
                                 @if ($audiovisual->guionistas->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->guionistas->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún guionista asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_guionista{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_guionista" placeholder="Buscar guionista..." />

                                     <button type="button" onclick="buscarGuionista('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="guionista{{ $audiovisual->id }}"
                                     name="guionista{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="guionistaResults{{ $audiovisual->id }}"
                                    class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para REPARTO -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_reparto" :value="__('Reparto:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre del reparto si ya está asignado -->
                                 @if ($audiovisual->repartos->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->repartos->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún actor/actriz asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_reparto{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_reparto" placeholder="Buscar reparto..." />

                                     <button type="button" onclick="buscarReparto('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="reparto{{ $audiovisual->id }}"
                                     name="reparto{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="repartoResults{{ $audiovisual->id }}"
                                    class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para COMPAÑÍA -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_company" :value="__('Compañía:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre de la compañía si ya está asignada -->
                                 @if ($audiovisual->companies->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->companies->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">
                                         Ninguna compañía asignada
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_company{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_company" placeholder="Buscar compañía..." />

                                     <button type="button" onclick="buscarCompany('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="company{{ $audiovisual->id }}"
                                     name="company{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="companyResults{{ $audiovisual->id }}"
                                    class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para GÉNERO -->
                             <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                 <!-- Título -->
                                 <x-input-label for="search_genero" :value="__('Género:')"
                                     class="block text-sm md:text-xl font-bold text-gray-900 dark:text-white md:mt-2" />

                                 <!-- Muestra el nombre deL GÉNERO si ya está asignado -->
                                 @if ($audiovisual->generos->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->generos->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre"
                                         class="block text-sm md:text-base font-medium text-gray-600">
                                         Ningún género asignado
                                     </label>
                                 @endif

                                 <!-- Campo de búsqueda -->
                                 <div class="flex items-center">
                                     <input id="search_genero{{ $audiovisual->id }}"
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-xs md:text-base"
                                         type="text" name="search_genero" placeholder="Buscar género..." />

                                     <button type="button" onclick="buscarGenero('{{ $audiovisual->id }}')"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600 text-xs md:text-base">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Campo de entrada oculto para almacenar el resultado de la búsqueda -->
                                 <input type="hidden" id="genero{{ $audiovisual->id }}"
                                     name="genero{{ $audiovisual->id }}" />

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul id="generoResults{{ $audiovisual->id }}"
                                     class="mt-1 space-y-1 md:space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-24 md:max-h-44 text-xs md:text-base">
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>

                 <!-- Modal footer -->
                 <div
                     class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                     <!-- Botoó para guardar edición -->
                     <button type="submit"
                         class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600 text-xs md:text-base">
                         Guardar
                     </button>

                     <!-- Espacio entre botones -->
                     <div class="w-4"></div>

                     <!-- Botoó para cancelar edición -->
                     <button data-modal-hide="ElencoModal{{ $audiovisual }}" type="button"
                         class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600 text-xs md:text-base">
                         Cancelar
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Scripts para los buscadores de forma asíncrona -->
 <script src="{{ asset('js/buscadorGeneros.js') }}"></script>
 <script src="{{ asset('js/buscadorCompanies.js') }}"></script>
 <script src="{{ asset('js/buscadorRepartos.js') }}"></script>
 <script src="{{ asset('js/buscadorGuionistas.js') }}"></script>
 <script src="{{ asset('js/buscadorFotografias.js') }}"></script>
 <script src="{{ asset('js/buscadorCompositores.js') }}"></script>
 <script src="{{ asset('js/buscadorDirectores.js') }}"></script>
