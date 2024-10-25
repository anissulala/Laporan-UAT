<?php

namespace App\Helpers\Test;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * @mixin TestCase
 */
trait LogRequest
{
    public function setUpLazilyRefreshDatabase(): void
    {
        Event::listen(function (Routing $event) {
            Log::debug('req >> ' . $event->request->method() . ' ' . $event->request->fullUrl());
        });

        Event::listen(function (RequestHandled $event) {
            Log::debug('resp << ' . $event->response->getStatusCode() . ' ' . (Response::$statusTexts[$event->response->getStatusCode()] ?? ''));
        });
    }
}
