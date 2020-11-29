<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\SiswaTes;

class UserState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $state = auth()->user()->state;

        if ($state->state == 'sedang_tes')
        {
            $siswa_tes_id = explode('-', $state->values);

            $siswates = SiswaTes::whereKey($siswa_tes_id)->firstOrFail();

            if (!($request->routeIs('siswa.tes.edit') || $request->routeIs('siswa.tes.update')))
            {
                return redirect()->route('siswa.tes.edit', [
                    $siswates->tes->modul_id,
                    $siswates->tes_id
                ]);
            }
        }

        return $next($request);
    }
}
