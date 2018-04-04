<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana\Functional;

use ScriptFUSION\Porter\Provider\Iana\Provider\Resource\IanaRootZones;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class IanaRootZonesTest extends IanaTest
{
    public function testRootZones()
    {
        $records = $this->porter->import(new ImportSpecification(new IanaRootZones));

        $counter = 0;
        foreach ($records as $record) {
            self::assertContains('.', $record['Domain']);
            self::assertContains(
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
            self::assertNotEmpty($record['TLD Manager']);

            ++$counter;
        }

        self::assertCount($counter, $records);
    }
}
