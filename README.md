[![Build Status](https://travis-ci.com/sanmai/phpunit-legacy-adapter.svg?branch=master)](https://travis-ci.com/sanmai/phpunit-legacy-adapter)

## PHPUnit Legacy Versions Adapter

As you're here, you are probably well aware that PHPUnit 8+ requires [common template methods](https://phpunit.readthedocs.io/en/latest/fixtures.html) 
like `setUp()` or `tearDown()` to have a `void` return type declaration, which methods naturally break anything below PHP 7.1.

Although it is not a big deal to automatically update your code to use these return type declaration with help from the likes of [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) or [Rector](https://github.com/rectorphp/rector/blob/master/docs/rector_rules_overview.md#phpunit), 
it might become a problem if, for whatever unfortunate (but, hopefully, lucrative) reasons, you have to ensure your code is working under PHP 7.0 or PHP 5.6, all the 
while wanting using the best world can give you in the more-less recent versions of PHPUnit.

In this case, you'll have two problems. One, newer versions of PHPUnit [do not have old assertions](https://thephp.cc/news/2019/02/help-my-tests-stopped-working), but you can find a way around this, and another,
as mentioned, newer versions of PHPUnit require  `void` return type declarations for the convenient template methods, and then you're stuck because 
rewriting tests to work without these template methods is a major pain and might be impossible even. And then this small library comes to save your day!

```
composer require --dev sanmai/phpunit-legacy-adapter:"^6 || ^8"
```

### How to use

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

There are similar replacements for most other template method:

```diff
- public static function setUpBeforeClass(): void
+ public static function legacySetUpBeforeClass()
```

```diff
- public static function tearDownAfterClass(): void
+ public static function legacyTearDownAfterClass()
```

```diff
- protected function setUp(): void
+ protected function legacySetUp()
```

```diff
- protected function tearDown(): void
+ protected function legacyTearDown()
```

```diff
- protected function assertPreConditions(): void
+ protected function legacyAssertPreConditions()
```

```diff
- protected function assertPostConditions(): void
+ protected function legacyAssertPostConditions()
```

### Reference

|  Method     | Replacement                   |
| ----------- | ----------------------------- |
| `setUpBeforeClass(): void` | `legacySetUpBeforeClass()` |
| `tearDownAfterClass(): void` | `legacyTearDownAfterClass()` |
| `setUp(): void` | `legacySetUp()` |
| `tearDown(): void` | `legacyTearDown()` |
| `assertPreConditions(): void` | `legacyAssertPreConditions()` |
| `assertPostConditions(): void` | `legacyAssertPostConditions()` |


### Supported versions

- 6.x version branch supports [PHPUnit 6](https://phpunit.de/getting-started/phpunit-6.html), [PHPUnit 5](https://phpunit.de/getting-started/phpunit-5.html), and [PHPUnit 4](https://phpunit.de/getting-started/phpunit-4.html).
- 8.x version branch supports [PHPUnit 7](https://phpunit.de/getting-started/phpunit-7.html), [PHPUnit 8](https://phpunit.de/getting-started/phpunit-8.html) and [PHPUnit 9](https://phpunit.de/getting-started/phpunit-9.html).
- Future versions will likely follow the same pattern.

### What this library does not do

Although this library solves the most annoying part of the problem, there are other parts the library was not designed to cover. For example:

- Some versions of PHPUnit allow `assertContains` to be used with strings, while other do not. 
- In some versions one method is called `expectExceptionMessageRegExp`, while in others the same method is called `expectExceptionMessageMatches`.
- And so on and on.

There might be a polyfill for these changed methods, but it should not be a big deal to write an ad hoc polyfill just for the methods you need. E.g.:

```php
    public function __call($method, $args)
    {
        if ($method === 'assertStringContainsString') {
            $this->assertContains(...$args);
        }
        
        if ($method === 'assertIsBool') {
            $this->assertTrue(\is_bool($args[0]));
        }
        
        if ($method === 'expectExceptionMessageRegExp') {
            $this->expectExceptionMessageMatches(...$args);
        }
    }
```

If there are several modular and not multi-version polyfills for these and other methods:

- One of the most used is one that comes with [Symfony's PHPUnit Bridge](https://github.com/symfony/phpunit-bridge). You can [check the source here](https://github.com/symfony/phpunit-bridge/tree/5.x/Legacy).
- There's [`yoast/phpunit-polyfills`](https://github.com/Yoast/PHPUnit-Polyfills/).
- There's [`phpunitgoodpractices/polyfill`](https://github.com/PHPUnitGoodPractices/polyfill)

