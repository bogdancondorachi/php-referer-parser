<?php
namespace Snowplow\RefererParser\Tests;

use Snowplow\RefererParser\Config\JsonConfigReader;
use Snowplow\RefererParser\Parser;

class JsonParserTest extends AbstractParserTest
{
	protected function createParser(array $internalHosts = []): Parser
	{
		return new Parser(
			configReader: new JsonConfigReader(dirname(__DIR__) . '/data/referers.json'),
			internalHosts: $internalHosts
		);
	}
}
