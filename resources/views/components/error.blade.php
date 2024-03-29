@props(['status'])

@if ($status)
    <div id="alert-3"
        class="flex items-center justify-center text-red-500 bg-red-200 border-red-500 rounded-lg p-2 my-4 transition-all duration-500 ease-in-out"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-lg font-medium flex-row w-full text-center">
            {{ $status }}
        </div>
        <button type="button"
            class="ml-auto text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:text-red-500 inline-flex justify-center items-center h-8 w-8 mr-1 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <script>
        // Oculta el mensaje automáticamente después de 5 segundos
        setTimeout(function() {
            var alert = document.getElementById('alert-3');
            if (alert) {
                alert.classList.add('opacity-0', 'transform', '-translate-y-2');
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }
        }, 3000);
    </script>
@endif
