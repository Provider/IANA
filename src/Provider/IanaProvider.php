<?php
namespace ScriptFUSION\Porter\Provider\Iana\Provider;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Provider\Provider;

final class IanaProvider implements Provider
{
    private $connector;

    public function __construct(Connector $connector = null)
    {
        // The default HttpConnector should suffice.
        $this->connector = $connector ?: new HttpConnector;
    }

    public function getConnector()
    {
        return $this->connector;
    }
}
