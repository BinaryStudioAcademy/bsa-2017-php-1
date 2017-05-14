<?php

namespace BinaryStudioAcademyTests\Task1;

use BinaryStudioAcademy\Task1\Pickachu;
use BinaryStudioAcademy\Task1\Bulbasaur;
use BinaryStudioAcademy\Task1\Slowpoke;
use BinaryStudioAcademy\Task1\Psyduck;
use BinaryStudioAcademy\Task1\Pokemon;
use BinaryStudioAcademy\Task1\PokemonTrainer;
use PHPUnit\Framework\TestCase;

class TrainerTest extends TestCase
{
    /**
     * @var PokemonTrainer
     */
    private $trainer;

    protected function setUp()
    {
        parent::setUp();

        $this->trainer = new PokemonTrainer();
    }

    public function test_can_create_pickachu()
    {
        $this->assertInstanceOf(Pickachu::class, new Pickachu);
    }

    public function test_can_create_bulbasaur()
    {
        $this->assertInstanceOf(Bulbasaur::class, new Bulbasaur);
    }

    public function test_can_create_slowpoke()
    {
        $this->assertInstanceOf(Slowpoke::class, new Slowpoke);
    }

    public function test_can_create_psyduck()
    {
        $this->assertInstanceOf(Psyduck::class, new Psyduck);
    }

    /**
     * @dataProvider pokemonDataProvider
     *
     * @param Pokemon $pokemon
     * @param string $expected
     */
    public function test_catch_them_all($pokemon, $expected)
    {
        $this->assertEquals($expected, $this->trainer->pick($pokemon));
    }

    public function pokemonDataProvider()
    {
        return [
            [new Pickachu, 'Pickachu: Pika-Pika!'],
            [new Bulbasaur, 'Bulbasaur: Bool bool!'],
            [new Slowpoke, 'Slowpoke: So slow!'],
            [new Psyduck, 'Psyduck: PSY!PSY!PSY!']
        ];
    }
}
