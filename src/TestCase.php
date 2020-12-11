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

namespace LegacyPHPUnit;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** {@inheritdoc} */
    public static function setUpBeforeClass()
    {
        static::legacySetUpBeforeClass();
        static::doSetUpBeforeClass();
    }

    public static function legacySetUpBeforeClass()
    {
    }

    public static function doSetUpBeforeClass()
    {
    }

    /** {@inheritdoc} */
    public static function tearDownAfterClass()
    {
        static::legacyTearDownAfterClass();
        static::doTearDownAfterClass();
    }

    public static function legacyTearDownAfterClass()
    {
    }

    public static function doTearDownAfterClass()
    {
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->legacySetUp();
        $this->doSetUp();
    }

    protected function legacySetUp()
    {
    }

    protected function doSetUp()
    {
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->legacyTearDown();
        $this->doTearDown();
    }

    protected function legacyTearDown()
    {
    }

    protected function doTearDown()
    {
    }

    /** {@inheritdoc} */
    protected function assertPreConditions()
    {
        $this->legacyAssertPreConditions();
        $this->doAssertPreConditions();
    }

    protected function legacyAssertPreConditions()
    {
    }

    protected function doAssertPreConditions()
    {
    }

    /** {@inheritdoc} */
    protected function assertPostConditions()
    {
        $this->legacyAssertPostConditions();
        $this->doAssertPostConditions();
    }

    protected function legacyAssertPostConditions()
    {
    }

    protected function doAssertPostConditions()
    {
    }
}
