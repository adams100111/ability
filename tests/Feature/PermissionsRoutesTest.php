<?php


use function Pest\Laravel\get;

it('can access roles index route', function () {
    get(route(config('ability.routes.role.index')))->assertStatus(200);
});
it('can access roles edit route', function () {
    get(route(config('ability.routes.role.edit')))->assertStatus(200);
});
it('can access roles show route', function () {
    get(route(config('ability.routes.role.show')))->assertStatus(200);
});
it('can access roles create route', function () {
    get(route(config('ability.routes.role.create')))->assertStatus(200);
});
it('can access roles update route', function () {
    get(route(config('ability.routes.role.update')))->assertStatus(200);
});
it('can access roles delete route', function () {
    get(route(config('ability.routes.role.delete')))->assertStatus(200);
});
