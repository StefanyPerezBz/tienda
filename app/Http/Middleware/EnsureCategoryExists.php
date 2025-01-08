<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCategoryExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si existe al menos una categoría activa
        if (Category::where('status', 'active')->count() == 0) {
            return redirect()->back()->with('error', 'Debe existir al menos una categoría activa antes de realizar esta acción.');
        }
        return $next($request);
    }
}
