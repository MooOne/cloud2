<?php

namespace Tests\Unit;

use Tests\TestCase;
use Yeelight\Models\Foundation\User;

class ModelTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        factory(User::class)->create();
    }
}
