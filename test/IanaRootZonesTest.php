<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana;

use ScriptFUSION\Porter\ImportSpecification;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Iana\IanaProvider;
use ScriptFUSION\Porter\Provider\Iana\IanaRootZones;

final class IanaRootZonesTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    private $porter;

    protected function setUp()
    {
        $this->porter = (new Porter)->addProvider(new IanaProvider);
    }

    public function testRootZones()
    {
        $records = $this->porter->import(new ImportSpecification(new IanaRootZones));

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
