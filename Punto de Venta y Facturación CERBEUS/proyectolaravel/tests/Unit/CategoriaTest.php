<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @test */
public function crearCategoria()
{
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)
        ->json('POST', '/categoria/registrar', [
            'nombre' => 'test',
            'descripcion' => 'this is a test'
        ]);

    $response->assertOk();

    $this->assertDatabaseHas('categorias', [
        'nombre' => 'test',
        'descripcion' => 'this is a test'
    ]);
}