<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Http\Services\TokenDecoder;

class EnsureEditedUserIsAdminOrHimself
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_settings = include base_path(). '/config/user.php';
        $user = User::find(TokenDecoder::decode($request)->sub);

        if(in_array($user->type, $user_settings['normal_types']) && $request->id != $user->id) {
            return redirect('/');
        } 

        return $next($request);
    }
}
