<?php
use PHPUnit\Framework\TestCase;

class SuggestionsTest extends TestCase
{
    public function testGetSuggestions()
    {
        // Create a mock for the PDO class
        $mockConnection = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create a mock for the PDOStatement class
        $mockStatement = $this->getMockBuilder(PDOStatement::class)
            ->getMock();
        
        // Set up the expected query and result
        $expectedTerm = 'example';
        $expectedRows = [['title' => 'Example Game 1'], ['title' => 'Example Game 2']];
        
        // Set the expectations for the mock statement
        $mockStatement->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn($expectedRows);

        // Set the expectations for the mock connection
        $mockConnection->expects($this->once())
            ->method('query')
            ->with("SELECT title FROM games WHERE title = '$expectedTerm'")
            ->willReturn($mockStatement);

        // Replace the global $yhteys variable with the mock connection
        global $yhteys;
        $yhteys = $mockConnection;

        // Invoke the get_suggestions.php script with a mock request
        $_GET['term'] = $expectedTerm;
        ob_start();
        include 'get_suggestions.php';
        $output = ob_get_clean();

        // Assert the expected JSON response
        $expectedResponse = json_encode(array_column($expectedRows, 'title'));
        $this->assertEquals($expectedResponse, $output);
    }
}


?>