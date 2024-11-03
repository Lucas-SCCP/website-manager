<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ReservaApiTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        // Configura o cliente HTTP para chamar a API local
        $this->client = new Client(['base_uri' => $_ENV['API_URL']]);
    }

    public function testGetReservasEndpoint()
    {
        // Faz uma requisição GET para o endpoint
        $response = $this->client->get('/users');

        // Verifica se o status de resposta é 200 OK
        $this->assertEquals(200, $response->getStatusCode());

        // Verifica se o corpo da resposta é um JSON válido
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data, 'O retorno das reservas não deveria ser vazio');
    }
}
