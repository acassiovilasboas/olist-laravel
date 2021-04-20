<?php

namespace Tests\Feature;

use App\Services\StatesOfBrazilService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Class StatesOfBrazilTest
 * @package Tests\Feature
 */
class StatesOfBrazilTest extends TestCase
{

    public function test_if_service_of_api_has_return_success()
    {
        $response = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

        $this->assertTrue($response->successful());
    }

    public function test_if_service_has_return_array()
    {
        $service = new StatesOfBrazilService();
        $response = $service->getStates();

        $this->assertTrue(Arr::accessible($response));
    }
}
