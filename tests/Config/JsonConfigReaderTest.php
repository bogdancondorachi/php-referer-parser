<?php
namespace Snowplow\RefererParser\Tests\Config;

use Snowplow\RefererParser\Config\JsonConfigReader;

class JsonConfigReaderTest extends AbstractConfigReaderTest
{
	protected function createConfigReader(string $fileName): JsonConfigReader
	{
		return new JsonConfigReader($fileName);
	}

	protected function createConfigReaderFromFile(): JsonConfigReader
	{
		return $this->createConfigReader(dirname(__DIR__, 2) . '/data/referers.json');
	}
}
