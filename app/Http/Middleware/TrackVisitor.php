<?php

namespace App\Http\Middleware;

use Closure;
use App\Visitor; // Pastikan namespace Model sesuai
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Admin\ProductGroupController;
class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        // Cek apakah pengunjung ini sudah tercatat hari ini?
        // Jika IP Address sama dan Tanggal sama, jangan catat lagi (supaya tidak spam)
        $ip = $request->ip();
        $date = date('Y-m-d');

        Visitor::firstOrCreate([
            'ip_address' => $ip,
            'visit_date' => $date
        ]);

        return $next($request);
    }
}