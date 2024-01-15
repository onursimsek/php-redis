<?php

namespace PhpRedis\Tests\Unit\Versions;

use PhpRedis\Enums\Version;
use PhpRedis\Versions\CommandList;
use PhpRedis\Versions\Version100;
use PhpRedis\Versions\Version120;
use PhpRedis\Versions\Version200;
use PhpRedis\Versions\Version220;
use PhpRedis\Versions\Version240;
use PhpRedis\Versions\Version260;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CommandList::class)]
class CommandListTest extends TestCase
{
    #[Test]
    public function get_versions_to_backwards()
    {
        $commandList = new CommandList(Version::V100->value);
        $version = new Version100(null);
        self::assertEquals($version->toArray(), $commandList->toArray());

        /*$commandList = new CommandList(Version::V120->value);
        $version = new Version120($version);
        self::assertEquals($version->toArray(), $commandList->toArray());

        $commandList = new CommandList(Version::V200->value);
        $version = new Version200($version);
        self::assertEquals($version->toArray(), $commandList->toArray());

        $commandList = new CommandList(Version::V220->value);
        $version = new Version220($version);
        self::assertEquals($version->toArray(), $commandList->toArray());

        $commandList = new CommandList(Version::V240->value);
        $version = new Version240($version);
        self::assertEquals($version->toArray(), $commandList->toArray());

        $commandList = new CommandList(Version::V260->value);
        $version = new Version260($version);
        self::assertEquals($version->toArray(), $commandList->toArray());

        $commandList = new CommandList(Version::V200->value);
        $version = new Version260($version);
        self::assertEquals($version->toArray(), $commandList->toArray());*/
    }
}
