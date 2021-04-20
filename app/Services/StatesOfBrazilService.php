<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;


class StatesOfBrazilService
{

    public function getStates(): ?array
    {
        $response = Http::get(env('SERVICE_URL_STATES_OF_BRAZIL'));

        return $response->json();
    }
}
