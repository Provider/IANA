<?php
namespace ScriptFUSION\Porter\Provider\Iana\Provider;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Provider\AbstractProvider;

final class IanaProvider extends AbstractProvider
{
    public function __construct(Connector $connector = null)
    {
        // The default HttpConnector should suffice.
        parent::__construct($connector ?: new HttpConnector);
    }
}
