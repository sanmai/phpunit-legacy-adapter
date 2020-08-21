[![Build Status](https://travis-ci.com/sanmai/phpunit-legacy-adapter.svg?branch=master)](https://travis-ci.com/sanmai/phpunit-legacy-adapter)

As you're here, you are probably well aware that PHPUnit 8+ requires [common template methods](https://phpunit.readthedocs.io/en/latest/fixtures.html) 
like `setUp()` or `tearDown()` to have a `void` return type declaration, which naturally break anything below PHP 7.1. 

Although it is not a big deal to automatically update your code to use these return type declaration with help from the likes of PHP-CS-Fixer or Rector, 
it might become a problem if, for whatever unfortunate reasons, you have to ensure your code is working under PHP 7.0 or earlier versions, all the 
while wanting using the best world can give you in the more-less recent versions of PHPUnit.

In this case, you'll have two problems. One, newer versions of PHPUnit do not have old assertions, but you can find a way around this, and another,
as mentioned, newer versions of PHPUnit require  `void` return type declarations for the convenient template methods, and then you're stuck because 
rewriting tests to work without these template methods is a major pain and might be impossible even. And then this small library comes to save your day!

```
composer require --dev sanmai/phpunit-legacy-adapter
```

First, update your tests to extend from `\LegacyPHPUnit\TestCase` instead of `\PHPUnit\Framework\TestCase`:

```diff
- class MyTest extends \PHPUnit\Framework\TestCase
+ class MyTest extends \LegacyPHPUnit\TestCase
```

Then, where you had to use `setUp(): void`  template method, use `legacySetUp()` method, omitting all any any return types in a fully backward-compatible way. 

```diff
- protected function setUp(): void
+ protected function legacySetUp()
```

There similar replacements for most other template method:

|  Template method     | Replacement          |
| ----------- | ----------------------------- |
| `public static function setUpBeforeClass(): void` | `public static function legacySetUpBeforeClass()` |
| `public static function tearDownAfterClass(): void` |    `public static function legacyTearDownAfterClass()` |
| `protected function setUp(): void` |     `protected function legacySetUp()` |
| `protected function tearDown(): void` |     `protected function legacyTearDown()` |
| `protected function assertPreConditions(): void` | `protected function legacyAssertPreConditions()`| 
| `protected function assertPostConditions(): void` |     `protected function legacyAssertPostConditions()`|
