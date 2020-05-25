<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $response = $this->get('/locale/en');
        $response->assertStatus(302);
    }

    public function testTranslation(){
        $response = $this->withSession(['locale' => 'pt-br'])->get('/');
        $response->assertSee('Tópicos mais Recentes');
    }
}
