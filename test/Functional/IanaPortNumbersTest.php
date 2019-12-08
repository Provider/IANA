<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Iana\Functional;

use ScriptFUSION\Porter\Provider\Iana\Provider\Resource\IanaPortNumbers;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class IanaPortNumbersTest extends IanaTest
{
    public function testPortNumbers(): void
    {
        $records = $this->porter->import(new ImportSpecification(new IanaPortNumbers));

        foreach ($records as $record) {
            self::assertTrue(isset($record['Service Name'][0]) || isset($record['Port Number'][0]));

            isset($record['Service Name'][0]) &&
                self::assertRegExp('[[\w-]+]', $record['Service Name']);
            isset($record['Port Number'][0]) &&
                self::assertRegExp('[\d+(?:-\d+)?]', $record['Port Number']);
            isset($record['Transport Protocol'][0]) &&
                self::assertContains($record['Transport Protocol'], ['tcp', 'udp', 'sctp', 'dccp']);
        }
    }
}
