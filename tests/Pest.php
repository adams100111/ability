<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use EOA\Ability\Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;

uses(RefreshDatabase::class);
uses(TestCase::class)->in(__DIR__);


/**
 * Set the currently logged in user for the application.
 *
 * @return TestCase
 */
function actingAs(Authenticatable $user, string $driver = null)
{
    return test()->actingAs($user, $driver);
}
