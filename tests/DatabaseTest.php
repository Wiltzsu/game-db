<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PDO;

class DatabaseTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=gamedb', 'username', 'password');
    }

    public function testDatabaseConnection()
    {
        $this->assertInstanceOf(PDO::class, $this->pdo);
    }

    public function testDatabaseContents()
    {
        $expected = [
            ['gameid' => 6, 'title' => 'Hyperviolent']
        ];

        $stmt = $this->pdo->query('SELECT gameid, title FROM games');
        $actual = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEquals($expected, $actual);
    }
}

//vendor/bin/phpunit tests/DatabaseTest.php