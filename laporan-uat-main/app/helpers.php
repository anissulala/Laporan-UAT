<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

function user(string $guard = null): User|null
{
    /** @var User $res */
    $res = Auth::guard($guard ?: config('auth.defaults.guard'))->user();
    return $res;
}

function userId(string $guard = null): int|null
{
    return user($guard)?->id;
}
