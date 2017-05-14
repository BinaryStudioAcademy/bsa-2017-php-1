<?php

namespace BinaryStudioAcademyTests\Task2;

use BinaryStudioAcademy\Task2\EmojiGenerator;
use PHPUnit\Framework\TestCase;

class EmojiGeneratorTest extends TestCase
{
    /**
     * @var EmojiGenerator
     */
    private $generator;

    protected function setUp()
    {
        parent::setUp();

        $this->generator = new EmojiGenerator();
    }

    /**
     * @dataProvider emojiDataProvider
     * @param $expected
     */
    public function test_emoji_yields_correctly($expected)
    {
        $generator = $this->generator->generate();

        $this->assertEquals($expected, iterator_to_array($generator));
    }

    public function emojiDataProvider()
    {
        return [
            [['😀', '😃', '😄', '😁', '😆', '😅', '😂']]
        ];
    }
}
