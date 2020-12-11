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

use PHPUnit\Runner\AfterLastTestHook;
use SebastianBergmann\Diff\Differ;

final class Tester implements AfterLastTestHook
{
    private static function assertSame(array $expected, array $actual)
    {
        if ($expected === $actual) {
            return;
        }

        if (\class_exists(Differ::class)) {
            echo "\n";
            $differ = new Differ();
            echo $differ->diff(
                \var_export($actual, true),
                \var_export($expected, true)
            );
        }

        echo "\nUnexpected call sequence.\n";

        exit(1);
    }

    public function executeAfterLastTest(): void
    {
        self::assertSame(Test::getExpectedCallSequence(), Test::getActualCallSequence());
    }
}
