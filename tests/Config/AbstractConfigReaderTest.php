<?php
namespace Snowplow\RefererParser\Tests\Config;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Snowplow\RefererParser\Config\ConfigReaderInterface;
use Snowplow\RefererParser\Exception\InvalidArgumentException;

abstract class AbstractConfigReaderTest extends TestCase
{
	abstract protected function createConfigReader(string $fileName): ConfigReaderInterface;

	abstract protected function createConfigReaderFromFile(): ConfigReaderInterface;

	#[Test]
	public function testExceptionIsThrownIfFileDoesNotExist(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File "INVALIDFILE" does not exist');

		$this->createConfigReader('INVALIDFILE');
	}

	#[Test]
	public function testAddReferer(): void
	{
		$reader = $this->createConfigReaderFromFile();

		$result = $reader->addReferer(
			'intra.example.com',
			'Custom search',
			'search',
			['searchq']
		);
		$this->assertNull($result);

		$res = $reader->lookup('intra.example.com');

		$this->assertIsArray($res);
		$this->assertArrayHasKey('source', $res);
		$this->assertArrayHasKey('medium', $res);
		$this->assertArrayHasKey('parameters', $res);

		$notFound = $reader->lookup('nosearch.example.com');
		$this->assertNull($notFound);
	}

	#[Test]
	public function testErrorOnAddingWrongReferer(): void
	{
		$reader = $this->createConfigReaderFromFile();

		$this->expectException(\TypeError::class);

		$reader->addReferer('intra.example.com', 'Custom search', 'search', 'noarray');
	}
}
