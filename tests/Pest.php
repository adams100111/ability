<?php

use EOA\Ability\Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class)->in(__DIR__);
uses(RefreshDatabase::class);


/**
 * Set the currently logged in user for the application.
 *
 * @return TestCase
 */
function actingAs(Authenticatable $user, string $driver = null)
{
    return test()->actingAs($user, $driver);
}
