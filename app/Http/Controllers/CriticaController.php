<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriticaRequest;
use App\Http\Requests\UpdateCriticaRequest;
use App\Notifications\NewCriticaNotification;
use App\Models\Audiovisual;
use App\Models\Critica;

class CriticaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    // Crear crítica para un audiovisual
    public function store(StoreCriticaRequest $request)
    {

        try {
            // Obtener el ID del usuario autenticado
            $user = auth()->user()->id;

            // Obtener los seguidores del usuario
            $seguidores = auth()->user()->seguidores;

            // Obtener el nombre de usuario para la notificación
            $usuarioCritica = auth()->user()->name;

            // Obtener la crítica y el ID del audiovisual del formulario de solicitud
            $critica = $request->critica;
            $audiovisual = $request->audiovisual;
            $tituloAudiovisual = Audiovisual::find($audiovisual);

            $existeCritica = Critica::where('user_id', $user)->where('audiovisual_id', $audiovisual)->first();

            // Verificar si el usuario ya ha realizado una crítica para este audiovisual
            if ($existeCritica) {
                return redirect()->back()->with('error', 'Ya has realizado una crítica para este audiovisual.');
            }

            // Verificar si la crítica está vacía
            if (empty($critica)) {
                return redirect()->back()->with('error', 'No puedes enviar una crítica vacía.');
            }

            // Crear una nueva instancia de la clase Critica y almacenarla en la base de datos
            Critica::create([
                'audiovisual_id' => $audiovisual,
                'user_id' => $user,
                'critica' => $critica,
            ]);

            // Envia la notificación a cada seguidor
            foreach ($seguidores as $seguidor) {
                $seguidor->notify(new NewCriticaNotification($usuarioCritica, $tituloAudiovisual->titulo));
            }

            // Redireccionar de nuevo a la ficha técnica del audiovisual
            return redirect()->back()->with('success', 'La crítica ha sido creada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }

    public function show(Critica $critica)
    {
        //
    }

    public function edit(Critica $critica)
    {
        //
    }

    // Editar una crítica
    public function update(UpdateCriticaRequest $request, $usuario_id, $audiovisual_id)
    {
        $referer = $request->headers->get('referer');

        try {
            // Intenta actualizar la crítica si ya existe, de lo contrario, la inserta
            Critica::updateOrInsert(
                ['user_id' => $usuario_id, 'audiovisual_id' => $audiovisual_id],
                ['critica' => $request->critica]
            );

            // Verifica la URL de referencia y realiza la redirección
            if (strpos($referer, 'http://127.0.0.1:8000/mis_criticas') !== false) {
                // Redirección si viene de la página anterior
                return redirect()->route('users.criticas')->with('success', 'La crítica se ha modificado correctamente.');
            } else {
                // Redirección si NO viene de la página anterior
                return redirect()->route('ver.criticas', $audiovisual_id)->with('success', 'La crítica se ha modificado correctamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }

    // Eliminar una crítica
    public function destroy(StoreCriticaRequest $request)
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user()->id;

        // Obtener el ID del audiovisual
        $audiovisualId = $request->audiovisual_id;

        // Eliminar la crítica correspondiente
        Critica::where('audiovisual_id', $audiovisualId)
            ->where('user_id', $user)
            ->delete();

        // Redireccionar de nuevo a la página anterior
        return redirect()->back()->with('success', 'La crítica se ha eliminado correctamente.');
    }
}
