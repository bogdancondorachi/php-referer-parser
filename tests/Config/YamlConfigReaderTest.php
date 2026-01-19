<?php
namespace Snowplow\RefererParser\Tests\Config;

use Snowplow\RefererParser\Config\YamlConfigReader;

class YamlConfigReaderTest extends AbstractConfigReaderTest
{
	protected function createConfigReader(string $fileName): YamlConfigReader
	{
		return new YamlConfigReader($fileName);
	}

	protected function createConfigReaderFromFile(): YamlConfigReader
	{
		return $this->createConfigReader(__DIR__ . '/../../data/referers.yml');
	}
}
