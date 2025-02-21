# string

String helper functionality for PHP

## Installation

```
composer require painless-php/string
```

## Public API

#### Core

* [Str](doc/Str.md)
* [StrBuilder](doc/StrBuilder.md)

#### Exception

* PainlessPHP\String\Exception\StringSearchException
* PainlessPHP\String\Exception\StringTypeConversionException

## TODO

* findFirstLineContaining
* findLinesContaining
* findLastLineContaining
* trimLines
* editLines

* update required php version (can check with package-boilerplate-core eventually)
* method overview (as markdown table? in readme) / update docs
* generate ide helper for StrBuilder so that magic methods are exposed to IDE
