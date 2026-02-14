<?php
namespace Snowplow\RefererParser\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Snowplow\RefererParser\Medium;
use Snowplow\RefererParser\Parser;

abstract class AbstractParserTest extends TestCase
{
	private Parser $parser;

	protected function setUp(): void
	{
		$this->parser = $this->createParser([
			'www.subdomain1.snowplowanalytics.com',
			'www.subdomain2.snowplowanalytics.com'
		]);
	}

	abstract protected function createParser(array $internalHosts = []): Parser;

	#[DataProvider('getTestData')]
	#[Test]
	public function testRefererParsing(mixed $_, ?string $refererUrl, ?string $medium, ?string $source, ?string $searchTerm, bool $isKnown): void
	{
		$referer = $this->parser->parse($refererUrl, 'http://www.snowplowanalytics.com/');

		$this->assertTrue($referer->isValid());
		$this->assertSame($isKnown, $referer->isKnown());
		$this->assertSame($source, $referer->getSource());
		$this->assertSame($medium, $referer->getMedium());
		$this->assertSame($searchTerm, $referer->getSearchTerm());
	}

	#[DataProvider('getErrorData')]
	#[Test]
	public function testHandleErrors(?string $refererUrl, ?string $internalUrl): void
	{
		$referer = $this->parser->parse($refererUrl, $internalUrl);

		$this->assertFalse($referer->isValid());
		$this->assertFalse($referer->isKnown());
	}

	#[Test]
	public function testCustomInternalHosts(): void
	{
		$parser = $this->createParser(['google.com']);

		$this->assertSame(Medium::INTERNAL->value, $parser->parse('http://google.com')->getMedium());
		$this->assertSame(Medium::SEARCH->value, $this->parser->parse('http://google.com')->getMedium());
	}

	public static function getTestData(): array
	{
		$data = json_decode(file_get_contents(__DIR__ . '/referer-tests.json'), true);

		$arguments = [];
		foreach ($data as $case) {
			$arguments[] = array_values($case);
		}

		return $arguments;
	}

	public static function getErrorData(): array
	{
		return [
			['ftp://google.com', null],
			[null, null],
			['invalidString', 'http://google.de'],
		];
	}
}
