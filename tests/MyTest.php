<?php
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    public function testSearchByTitle()
    {
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost/gamedb/index.php', [
            'form_params' => [
                'title' => 'Assassin\'s Creed Valhalla',
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Search Results', str_split($response->getBody()));
        $this->assertContains('Assassin\'s Creed Valhalla', str_split($response->getBody()));
    }
}

?>
