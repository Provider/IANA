<?php
namespace ScriptFUSION\Porter\Provider\Iana;

use League\Csv\Reader;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\ProviderData;

class IanaPortNumbers implements ProviderData
{
    public function getProviderName()
    {
        return IanaProvider::class;
    }

    public function fetch(Connector $connector)
    {
        $csv = $connector->fetch(
            'http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.csv'
        );

        $reader = Reader::createFromString($csv);

        foreach ($reader->fetchAssoc() as $row) {
            yield $row;
        }
    }
}
