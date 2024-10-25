<?php

namespace Tests;

use App\Helpers\Test\LazilyRefreshDatabase;
use App\Helpers\Test\LogRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase;
    use LogRequest;
}
