# ❄️ PHP Snowplow Referer Parser

A modern PHP implementation of [referer-parser](https://github.com/snowplow-referer-parser/referer-parser), the library for extracting **traffic attribution data** from referer _(sic)_ URLs.

The implementation uses a JSON version of the shared `database` of known referers found in [`referers.yml`](https://github.com/snowplow-referer-parser/referer-parser/blob/master/resources/referers.yml).

🔱 This repository is a maintained fork of the original [php-referer-parser](https://github.com/snowplow-referer-parser/php-referer-parser) created by [Lars Strojny](https://github.com/lstrojny), updated for modern PHP versions and ongoing data updates.

## ✨ Key Features
- 🌍 Parse referer URLs into structured attribution data
- 🧭 Identify traffic source and medium (search, social, email, etc.)
- 📝 Extract search terms from supported search engines
- 📦 Based on Snowplow’s shared referer database
- ⚡ Modern PHP 8.2+ implementation
- 🔁 Regularly updated referer data

## 🧩 Requirements
- **PHP** ≥ 8.2

## 📦 Installation

```bash
composer require simplestats/referer-parser
```

## 🚀 Usage

```php
use Snowplow\RefererParser\Parser;

$parser = new Parser();
$referer = $parser->parse(
    'http://www.google.com/search?q=gateway+oracle+cards+denise+linn&hl=en&client=safari',
    'http:/www.psychicbazaar.com/shop'
);

if ($referer->isKnown()) {
    echo $referer->medium;     // Medium::SEARCH
    echo $referer->source;     // "Google"
    echo $referer->searchTerm; // "gateway oracle cards denise linn"
}
```

## 🤝 Contributing
1. Fork this repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create new pull request

## 🙏 Credits
- 🧠 [Snowplow](https://github.com/snowplow) for the original [referer-parser](https://github.com/snowplow-referer-parser/referer-parser) library
- 👤 [Lars Strojny](https://github.com/lstrojny) for the original [php-referer-parser](https://github.com/snowplow-referer-parser/php-referer-parser)

## 📜 License
[MIT License](./LICENSE) Copyright © 2026-PRESENT [Bogdan Condorachi](https://github.com/bogdancondorachi)\
[MIT License](https://github.com/snowplow-referer-parser/php-referer-parser/blob/develop/MIT-LICENSE.txt) Copyright © 2013-PRESENT [Lars Strojny](https://github.com/lstrojny)