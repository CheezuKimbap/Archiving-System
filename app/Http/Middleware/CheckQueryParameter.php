<?php

namespace App\Http\Middleware;

use App\Models\Municipality;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FileType;
class CheckQueryParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validTypes = FileType::where('classification_id', 1)->pluck('type_name')->toArray();
        $validRecords = FileType::where('classification_id', 2)->pluck('type_name')->toArray();
        $validMunicipality = Municipality::pluck('location')->toArray();

        if ($request->has('type')) {
            // Validate the 'type' parameter
            if (!in_array($request->query('type'), $validTypes)) {
                abort(404);
            }
        }
        if ($request->has('record')) {
            // Validate the 'type' parameter
            if (!in_array($request->query('record'), $validRecords)) {
                abort(404);
            }
        }
        if ($request->has('municipality')) {
            if (!in_array($request->query('municipality'), $validMunicipality)) {
                abort(404);
            }

        }

        return $next($request);
    }
}
