<?php declare(strict_types=1);

namespace Zalas\Toolbox\Tests\Tool\Command;

use PHPUnit\Framework\TestCase;
use Zalas\Toolbox\Tool\Command;
use Zalas\Toolbox\Tool\Command\ComposerGlobalInstallCommand;

class ComposerGlobalInstallCommandTest extends TestCase
{
    const PACKAGE = 'phan/phan';

    /**
     * @var ComposerGlobalInstallCommand
     */
    private $command;

    protected function setUp()
    {
        $this->command = ComposerGlobalInstallCommand::import([
            'package' => self::PACKAGE,
        ]);
    }

    public function test_it_is_a_command()
    {
        $this->assertInstanceOf(Command::class, $this->command);
    }

    public function test_it_generates_the_installation_command()
    {
        $this->assertRegExp('#composer global require .*? phan/phan#', (string) $this->command);
    }

    public function test_it_complains_if_package_is_missing()
    {
        $this->expectException(\InvalidArgumentException::class);

        ComposerGlobalInstallCommand::import([]);
    }

    public function test_it_exposes_the_package_name()
    {
        $this->assertSame(self::PACKAGE, $this->command->package());
    }
}