<?php

namespace PhpRedis\Tests\Unit\Versions;

use PhpRedis\Versions\Version100;
use PhpRedis\Versions\Version120;
use PhpRedis\Versions\Version200;
use PhpRedis\Versions\Version220;
use PhpRedis\Versions\Version240;
use PhpRedis\Versions\Version260;
use PhpRedis\Versions\Version280;
use PhpRedis\Versions\Version300;
use PhpRedis\Versions\Version320;
use PhpRedis\Versions\Version400;
use PhpRedis\Versions\Version500;
use PhpRedis\Versions\Version600;
use PhpRedis\Versions\Version720;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class VersionsTest extends TestCase
{
    #[Test]
    public function versions_and_commands()
    {
        $version = new Version100(null);
        self::assertCount(52, $version->toArray());

        $version = new Version120($version);
        self::assertCount(62, $version->toArray());

        $version = new Version200($version);
        self::assertCount(84, $version->toArray());

        $version = new Version220($version);
        self::assertCount(95, $version->toArray());

        $version = new Version240($version);
        self::assertCount(98, $version->toArray());

        $version = new Version260($version);
        self::assertCount(110, $version->toArray());

        $version = new Version280($version);
        self::assertCount(119, $version->toArray());

        $version = new Version300($version);
        self::assertCount(120, $version->toArray());

        $version = new Version320($version);
        self::assertCount(131, $version->toArray());

        $version = new Version400($version);
        self::assertCount(132, $version->toArray());

        $version = new Version500($version);
        self::assertCount(138, $version->toArray());

        $version = new Version600($version);
        self::assertCount(144, $version->toArray());

        $version = new Version720($version);
        self::assertCount(144, $version->toArray());
    }
}
