<?php

namespace BinaryStudioAcademyTests\Task3;

use PHPUnit\Framework\TestCase;

class BuiltInServerTest extends TestCase
{
    const TEST_REGEX = '/<img src=\"https:\/\/img\.pokemondb\.net\/artwork\/(pikachu|bulbasaur|psyduck|slowpoke)\.jpg\"\/?>/';

    /**
     * @var BuiltInServerRunner
     */
    private $runner;

    protected function setUp()
    {
        parent::setUp();
        $this->runner = new BuiltInServerRunner();
        $this->runner->start();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->runner->stop();
    }

    public function test_built_in_server_should_be_live()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);
        $this->assertContains('<title>Built-in Web Server</title>', $page);
    }

    public function test_can_see_task_items()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $this->assertRegExp(self::TEST_REGEX, $page);
        $this->assertExactAmountOfPokemons($page);
        $this->assertPokemonsLinksAreUnique($page);
    }

    private function assertExactAmountOfPokemons(string $page)
    {
        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $this->assertCount(4, $matches);
    }

    private function assertPokemonsLinksAreUnique(string $page)
    {
        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $names = array_map(function($match) { return $match[1]; }, $matches);

        $expected = ['pikachu', 'bulbasaur', 'psyduck', 'slowpoke'];

        $this->assertCount(0, array_diff($expected, $names));
    }
}
