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
    private const EXPECTED_SEQUENCE = [
        '::legacySetUpBeforeClass',
        '::legacySetUp',
        '::legacyAssertPreConditions',
        '::legacyAssertPostConditions',
        '::legacyTearDown',
        '::legacyTearDownAfterClass',
    ];

    private static $callSequence = [];

    public function testExample(): void
    {
        $this->assertTrue(true);
    }

    private static function add(string $methodName): void
    {
        self::$callSequence[] = $methodName;
    }

    public static function getActualCallSequence(): array
    {
        return self::$callSequence;
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

    public static function legacyTearDownAfterClass()
    {
        self::add(__METHOD__);
    }

    protected function legacySetUp()
    {
        self::add(__METHOD__);
    }

    protected function legacyTearDown()
    {
        self::add(__METHOD__);
    }

    protected function legacyAssertPreConditions()
    {
        self::add(__METHOD__);
    }

    protected function legacyAssertPostConditions()
    {
        self::add(__METHOD__);
    }
}
