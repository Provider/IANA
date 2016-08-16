<?php
namespace ScriptFUSION\Porter\Provider\Iana\Provider\Resource;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;
use ScriptFUSION\Porter\Provider\Resource\AbstractResource;
use Symfony\Component\DomCrawler\Crawler;

class IanaRootZones extends AbstractResource
{
    public function getProviderClassName()
    {
        return IanaProvider::class;
    }

    public function fetch(Connector $connector)
    {
        $html = $connector->fetch('http://www.iana.org/domains/root/db');

        $crawler = new Crawler($html);
        $tldTable = $crawler->filterXPath('//table[@id="tld-table"]');
        $headers = $tldTable->filterXPath('./*/thead/tr/th')->extract('_text');
        $cells = $tldTable->filterXPath('./*/tbody/tr/td')->extract('_text');

        $yield = function ($rows) use ($headers) {
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
