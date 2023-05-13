<?php
use PHPUnit\Framework\TestCase;
// This line includes the TestCase class from the PHPUnit\Framework 
// namespace, which provides the base functionality for writing PHPUnit tests.

class HomePageTest extends TestCase
// This line defines a new class named HomePageTest that 
// extends TestCase, indicating that it is a PHPUnit test class.
{
    public function testHomePage()
    // This line defines a new test method named testHomePage that 
    // will be executed by PHPUnit when the test suite is run.
    {
        $client = new GuzzleHttp\Client();
        // Creates a new instance of the GuzzleHttp\Client class, which is used 
        // to send HTTP requests to the website being tested.
        $response = $client->request('GET', 'http://localhost/gamedb/index.php');
        // This line sends an HTTP GET request to the specified URL and assigns 
        // the response to the $response variable.

        $this->assertEquals(200, $response->getStatusCode());
        // This line uses an assertion to verify that the HTTP response status 
        // code is equal to 200, indicating that the request was successful and 
        // the homepage was loaded. If the assertion fails, the test will be 
        // marked as a failure.
    }
}
//vendor/bin/phpunit tests/HomePageTest.php
?>

