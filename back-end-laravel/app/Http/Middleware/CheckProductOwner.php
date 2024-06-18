<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckProductOwner
{
    public function handle(Request $request, Closure $next)
    {
        $product = $request->route('product'); // Assumendo che il parametro route si chiami 'product'

        if (!$product || $product->restaurant->user_id !== Auth::id()) {
            abort(404);
        }

        return $next($request);
    }
}
