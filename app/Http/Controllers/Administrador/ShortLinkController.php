<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Http;

class ShortLinkController extends Controller
{
    public function __invoke(ShortLink $shortlink)
    {
        $ip = env('APP_ENV') == 'local' ? '181.67.166.25' : request()->ip();
        $ipInfo = Http::get("http://ip-api.com/json/{$ip}")->object();

        Visit::create([
            'lugar' => $ipInfo->country,
            'short_link_id' => $shortlink->id
        ]);

        return redirect($shortlink->url);
    }
}
