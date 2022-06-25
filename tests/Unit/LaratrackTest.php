<?php

namespace Andr3a\Laratrack\Tests\Unit;

use Andr3a\Laratrack\Laratrack;
use Andr3a\Laratrack\Tests\TestCase;

class LaratrackTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function laratrack_instantiate_correctly()
    {
        $service = $this->app->make(Laratrack::class);

        $this->assertInstanceOf('Andr3a\Laratrack\Laratrack', $service);
    }
}
