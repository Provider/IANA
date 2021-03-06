<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Iana\Provider\Resource;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;
use Symfony\Component\DomCrawler\Crawler;

class IanaRootZones implements ProviderResource
{
    public function getProviderClassName(): string
    {
        return IanaProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $html = $connector->fetch(new HttpDataSource('http://www.iana.org/domains/root/db'));

        $crawler = new Crawler("$html");
        $tldTable = $crawler->filterXPath('//table[@id="tld-table"]');
        $headers = $tldTable->filterXPath('./*/thead/tr/th')->extract('_text');
        $cells = $tldTable->filterXPath('./*/tbody/tr/td')->extract('_text');

        $yield = static function ($rows) use ($headers): \Generator {
            foreach ($rows as $row) {
                $row[0] = ltrim($row[0]);

                yield array_combine($headers, $row);
            }
        };

        return new CountableProviderRecords(
            $yield(array_chunk($cells, count($headers))),
            count($cells) / count($headers),
            $this
        );
    }
}
