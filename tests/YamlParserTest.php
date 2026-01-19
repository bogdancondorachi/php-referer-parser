<?php
namespace Snowplow\RefererParser\Tests;

use PHPUnit\Framework\Attributes\BeforeClass;
use Snowplow\RefererParser\Config\YamlConfigReader;
use Snowplow\RefererParser\Parser;

class YamlParserTest extends AbstractParserTest
{
	private static YamlConfigReader $reader;

	#[BeforeClass]
	public static function setUpReader(): void
	{
		static::$reader = new YamlConfigReader(__DIR__ . '/../data/referers.yml');
	}

	protected function createParser(array $internalHosts = []): Parser
	{
		return new Parser(
			configReader: static::$reader,
			internalHosts: $internalHosts
		);
	}
}
