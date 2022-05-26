<?php

use PHPUnit\Framework\TestCase;


final class IndexControllerTest extends TestCase
{

    private $http;

    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => getenv('APP_URL')]);

    }

    public function tearDown(): void
    {
        $this->http = null;
    }


    /** @test */
    public function RequestIndexPage_GetResponseStatus200(): void
    {
        $response = $this->http->request('GET', '');

        $this->assertEquals(200, $response->getStatusCode());
    }



}