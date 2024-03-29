function buscarDirector(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_director" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var directorResults = document.getElementById(
        "directorResults" + audiovisualId
    );
    var directorInput = document.getElementById(
        "search_director" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("directorResults" + audiovisualId).innerHTML =
            "";
        directorResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/director", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            directorResults.innerHTML = "";

            var directores = response.data.directores;

            if (Array.isArray(directores) && directores.length > 0) {
                // Agregar estilos a la lista de resultados
                directorResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos a cada elemento de la lista
                directores.forEach(function (resultado) {
                    var li = document.createElement("li");
                    li.classList.add(
                        "hover:bg-blue-200",
                        "transition",
                        "duration-300",
                        "ease-in-out"
                    );
                    li.textContent = resultado.nombre;

                    // Manejar el clic en el elemento de la lista
                    li.addEventListener("click", function () {
                        // Asignar el valor del director seleccionado al campo de entrada
                        directorInput.value = resultado.nombre;

                        // Obtener el campo de entrada oculto y asignar el ID del director
                        var directorHiddenInput = document.getElementById(
                            "director" + audiovisualId
                        );
                        directorHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        directorResults.innerHTML = "";
                        directorResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    // Agregar el elemento de la lista al contenedor de resultados
                    directorResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron directores.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
