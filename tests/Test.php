<?php
/**
 * Copyright 2020 Alexey Kopytko <alexey@kopytko.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace Tests\LegacyPHPUnit;

use LegacyPHPUnit\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class Test extends TestCase
{
    const EXPECTED_SEQUENCE_LEN = 12;

    private const EXPECTED_SEQUENCE = [
        '::legacySetUpBeforeClass',
        '::doSetUpBeforeClass',

        '::legacySetUp',
        '::doSetUp',

        '::legacyAssertPreConditions',
        '::doAssertPreConditions',

        '::legacyAssertPostConditions',
        '::doAssertPostConditions',

        '::legacyTearDown',
        '::doTearDown',

        '::legacyTearDownAfterClass',
        '::doTearDownAfterClass',
    ];

    private static $callSequence = [];

    public function testExample(): void
    {
        if (self::EXPECTED_SEQUENCE_LEN !== \count(self::getExpectedCallSequence())) {
            $this->fail(\sprintf('EXPECTED_SEQUENCE_LEN needs an update to %d', \count(self::getExpectedCallSequence())));
        }

        $this->assertTrue(\count(self::$callSequence) > 0);

        if (\count(self::$callSequence) > self::EXPECTED_SEQUENCE_LEN) {
            $this->assertSame(
                \array_slice(self::$callSequence, 0, self::EXPECTED_SEQUENCE_LEN),
                self::getExpectedCallSequence()
            );
        }
    }

    private static function add(string $methodName): void
    {
        self::$callSequence[] = $methodName;
    }

    public static function getActualCallSequence(): array
    {
        return \array_slice(self::$callSequence, 0, self::EXPECTED_SEQUENCE_LEN);
    }

    public static function getExpectedCallSequence(): array
    {
        return \array_map(function (string $method): string {
            return self::class.$method;
        }, self::EXPECTED_SEQUENCE);
    }

    public static function legacySetUpBeforeClass()
    {
        self::add(__METHOD__);
    }

    public static function doSetUpBeforeClass()
    {
        self::add(__METHOD__);
    }

    public static function legacyTearDownAfterClass()
    {
        self::add(__METHOD__);
    }

    public static function doTearDownAfterClass()
    {
        self::add(__METHOD__);
    }

    protected function legacySetUp()
    {
        self::add(__METHOD__);
    }

    protected function doSetUp()
    {
        self::add(__METHOD__);
    }

    protected function legacyTearDown()
    {
        self::add(__METHOD__);
    }

    protected function doTearDown()
    {
        self::add(__METHOD__);
    }

    protected function legacyAssertPreConditions()
    {
        self::add(__METHOD__);
    }

    protected function doAssertPreConditions()
    {
        self::add(__METHOD__);
    }

    protected function legacyAssertPostConditions()
    {
        self::add(__METHOD__);
    }

    protected function doAssertPostConditions()
    {
        self::add(__METHOD__);
    }
}
