<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Iana\Provider\Resource;

use League\Csv\Reader;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class IanaPortNumbers implements ProviderResource
{
    public function getProviderClassName(): string
    {
        return IanaProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $csv = $connector->fetch(new HttpDataSource(
            'http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.csv'
        ));

        $reader = Reader::createFromString($csv);

        foreach ($reader->fetchAssoc() as $row) {
            yield $row;
        }
    }
}
