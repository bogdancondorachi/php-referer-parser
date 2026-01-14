<?php
namespace Snowplow\RefererParser\Tests;

use Snowplow\RefererParser\Config\YamlConfigReader;
use Snowplow\RefererParser\Parser;

class YamlParserTest extends AbstractParserTest
{
	private static YamlConfigReader $reader;

	public static function setUpBeforeClass(): void
	{
		static::$reader = new YamlConfigReader(dirname(__DIR__, 1) . '/data/referers.yml');
	}

	protected function createParser(array $internalHosts = []): Parser
	{
		return new Parser(
			configReader: static::$reader,
			internalHosts: $internalHosts
		);
	}
}
