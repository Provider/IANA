<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\ImportSpecification;
use ScriptFUSION\Porter\Provider\Iana\IanaRootZones;

final class IanaRootZonesTest extends IanaTest
{
    public function testRootZones()
    {
        $records = $this->porter->import(new ImportSpecification(new IanaRootZones));
        $this->assertInstanceOf(CountableProviderRecords::class, $records);

        $i = 0;
        foreach ($records as $record) {
            $this->assertContains('.', $record['Domain']);
            $this->assertContains(
                $record['Type'],
                [
                    // TODO: Create enumeration.
                    'generic',
                    'generic-restricted',
                    'country-code',
                    'infrastructure',
                    'sponsored',
                    'test',
                ]
            );
            $this->assertNotEmpty($record['Sponsoring Organisation']);

            ++$i;
        }

        $this->assertCount($i, $records);
    }
}
