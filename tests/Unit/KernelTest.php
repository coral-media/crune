<?php


namespace App\Test\Unit;


use App\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class KernelTest extends TestCase
{
    public function testKernel(): void
    {
        $kernel = new Kernel();

        $this->assertInstanceOf(Application::class, $kernel);
        $this->assertEquals('UNKNOWN', $kernel->getName());
        $this->assertEquals('UNKNOWN', $kernel->getVersion());
    }
}