<?php

namespace BinaryStudioAcademyTests\Task3;

class BuiltInServerRunner
{
    const START_COMMAND = 'php -S %s:%d -t %s >/dev/null 2>&1 & echo $!';
    const STOP_COMMAND = 'kill %s';
    const HOST = 'localhost';
    const PORT = 1234;
    const DOCUMENT_ROOT = __DIR__ . '/../../src/Task3/';
    const TEST_ENDPOINT = 'http://localhost:1234';

    private static $pid;

    public function start()
    {
        $command = sprintf(
            self::START_COMMAND,
            self::HOST,
            self::PORT,
            self::DOCUMENT_ROOT
        );

        $result = [];

        exec($command, $result);

        self::$pid = $result[0];

        sleep(1);
    }

    public function stop()
    {
        if (self::$pid) {
            exec(sprintf(self::STOP_COMMAND, self::$pid));
        }
    }
}
