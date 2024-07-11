<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para verificar el rol del usuario y aplicar habilidades de políticas opcionales.
 *
 * Este middleware asegura que el usuario autenticado tiene el rol especificado
 * y, opcionalmente, verifica habilidades adicionales en un modelo dado utilizando políticas.
 *
 * @package App\Http\Middleware
 */
class CheckRole
{
    /**
     * Maneja una solicitud entrante.
     *
     * Este método verifica si el usuario autenticado tiene el rol requerido. Si se especifica
     * una habilidad, además verifica si el usuario está autorizado para realizar la habilidad
     * especificada en un modelo dado. Si alguna de estas verificaciones falla, se retorna una
     * respuesta 403 de acceso denegado.
     *
     * @param Request $request La solicitud HTTP entrante.
     * @param Closure $next El siguiente middleware en la cadena de solicitudes.
     * @param string $role El rol requerido que el usuario debe tener para proceder.
     * @param string|null $ability Una habilidad opcional que el usuario debe tener sobre el modelo.
     * @param Model|null $model Una instancia de modelo opcional para verificar la habilidad.
     *
     * @return Response Retorna el siguiente manejador de la solicitud si pasan las verificaciones, de lo contrario, una respuesta 403.
     *
     * @throws AuthorizationException Si el usuario no tiene el rol o habilidad requerida.
     */
    public function handle(Request $request, Closure $next, string $role, ?string $ability = null, ?Model $model = null): Response
    {
        // Verificar si el usuario está autenticado y tiene el rol adecuado
        if (!Auth::check() || Auth::user()->profile->name !== $role) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        // Si se especifica una habilidad, usar el middleware `can` para verificar la política
        if ($ability && !Gate::allows($ability, $model ?: $request->route()->parameter('customer'))) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }
}
