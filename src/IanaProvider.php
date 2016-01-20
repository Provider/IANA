<?php
namespace ScriptFUSION\Porter\Provider\Iana;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Connector\HttpConnector;
use ScriptFUSION\Porter\Provider\Provider;

class IanaProvider extends Provider
{
    public function __construct(Connector $connector = null)
    {
        // The default HttpConnector should suffice.
        parent::__construct($connector ?: new HttpConnector);
    }
}
