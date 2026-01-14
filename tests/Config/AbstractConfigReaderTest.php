<?php
namespace Snowplow\RefererParser\Tests\Config;

use PHPUnit\Framework\TestCase;
use Snowplow\RefererParser\Config\ConfigReaderInterface;
use Snowplow\RefererParser\Exception\InvalidArgumentException;

abstract class AbstractConfigReaderTest extends TestCase
{
	/** @return ConfigReaderInterface */
	abstract protected function createConfigReader(string $fileName): ConfigReaderInterface;

	/** @return ConfigReaderInterface */
	abstract protected function createConfigReaderFromFile(): ConfigReaderInterface;

	public function testExceptionIsThrownIfFileDoesNotExist(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File "INVALIDFILE" does not exist');

		$this->createConfigReader('INVALIDFILE');
	}

	public function testAddReferer(): void
	{
		$reader = $this->createConfigReaderFromFile();

		// Adding referer should return null
		$this->assertNull($reader->addReferer(
			'intra.example.com',
			'Custom search',
			'search',
			['searchq']
		));

		$res = $reader->lookup('intra.example.com');

		$this->assertArrayHasKey('source', $res);
		$this->assertArrayHasKey('medium', $res);
		$this->assertArrayHasKey('parameters', $res);

		// Lookup for non-existing referer should return null
		$this->assertNull($reader->lookup('nosearch.example.com'));
	}

	public function testErrorOnAddingWrongReferer(): void
	{
		$reader = $this->createConfigReaderFromFile();

		$this->expectException(\TypeError::class);

		// Passing a string instead of array for parameters should throw TypeError
		$reader->addReferer('intra.example.com', 'Custom search', 'search', 'noarray');
	}
}
