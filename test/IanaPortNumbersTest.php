<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana;

use ScriptFUSION\Porter\Collection\ProviderRecords;
use ScriptFUSION\Porter\ImportSpecification;
use ScriptFUSION\Porter\Provider\Iana\IanaPortNumbers;

final class IanaPortNumbersTest extends IanaTest
{
    public function test()
    {
        $records = $this->porter->import(new ImportSpecification(new IanaPortNumbers));
        $this->assertInstanceOf(ProviderRecords::class, $records);

        foreach ($records as $record) {
            $this->assertTrue(isset($record['Service Name'][0]) || isset($record['Port Number'][0]));

            isset($record['Service Name'][0]) &&
                $this->assertRegExp('[[\w-]+]', $record['Service Name']);
            isset($record['Port Number'][0]) &&
                $this->assertRegExp('[\d+(?:-\d+)?]', $record['Port Number']);
            isset($record['Transport Protocol'][0]) &&
                $this->assertContains($record['Transport Protocol'], ['tcp', 'udp', 'sctp', 'dccp']);
        }
    }
}
