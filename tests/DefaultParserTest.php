<?php
namespace Snowplow\RefererParser\Tests;

use Snowplow\RefererParser\Parser;

class DefaultParserTest extends AbstractParserTest
{
	protected function createParser(array $internalHosts = []): Parser
	{
		return new Parser(internalHosts: $internalHosts);
	}
}
