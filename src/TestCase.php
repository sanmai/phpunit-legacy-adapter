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

namespace LegacyPHPUnit;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** {@inheritdoc} */
    public static function setUpBeforeClass(): void
    {
        static::legacySetUpBeforeClass();
    }

    /** {@inheritdoc} */
    public static function tearDownAfterClass(): void
    {
        static::legacyTearDownAfterClass();
    }

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->legacySetUp();
    }

    /** {@inheritdoc} */
    protected function tearDown(): void
    {
        $this->legacyTearDown();
    }

    /** {@inheritdoc} */
    protected function assertPreConditions(): void
    {
        $this->legacyAssertPreConditions();
    }

    /** {@inheritdoc} */
    protected function assertPostConditions(): void
    {
        $this->legacyAssertPostConditions();
    }

    // All replacement methods should go below. They better to be in a trait, but we don't have traits in PHP 5.3.

    public static function legacySetUpBeforeClass()
    {
    }

    public static function doSetUpBeforeClass()
    {
    }

    public static function legacyTearDownAfterClass()
    {
    }

    public static function doTearDownAfterClass()
    {
    }

    protected function legacySetUp()
    {
    }

    protected function doSetUp()
    {
    }

    protected function legacyTearDown()
    {
    }

    protected function doTearDown()
    {
    }

    protected function legacyAssertPreConditions()
    {
    }

    protected function doAssertPreConditions()
    {
    }

    protected function legacyAssertPostConditions()
    {
    }

    protected function doAssertPostConditions()
    {
    }
}
