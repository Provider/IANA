<?php
namespace ScriptFUSION\Porter\Provider\Iana;

use League\Csv\Reader;
use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Provider;
use ScriptFUSION\Porter\Provider\ProviderDataType;
use Symfony\Component\DomCrawler\Crawler;

class IanaProvider extends Provider
{
    public function getName()
    {
        return new IanaProviderName;
    }

    public function fetch(ProviderDataType $dataType, array $parameters = [])
    {
        switch ("$dataType") {
            case IanaDataType::PORT_NUMBERS:
                return $this->fetchPortNumbers();

            case IanaDataType::ROOT_ZONES:
                return $this->fetchRootZones();
        }

        parent::fetch($dataType);
    }

    public function fetchPortNumbers()
    {
        $csv = $this->getConnector()->fetch(
            'http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.csv'
        );

        $reader = Reader::createFromString($csv);

        foreach ($reader->fetchAssoc() as $row) {
            yield $row;
        }
    }

    public function fetchRootZones()
    {
        $html = $this->getConnector()->fetch('http://www.iana.org/domains/root/db');

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
            new IanaDataType(IanaDataType::ROOT_ZONES)
        );
    }
}
