<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfSpecifiedUserExists()
    {
        $request = $this->get(route('user.get', ['id' => 99999]));
        $request->assertResponseStatus(204);
    }
}