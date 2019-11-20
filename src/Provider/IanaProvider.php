<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Iana\Provider;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Net\Http\HttpOptions;
use ScriptFUSION\Porter\Provider\Provider;

final class IanaProvider implements Provider
{
    private $connector;

    public function __construct(Connector $connector = null)
    {
        // The default HttpConnector should suffice.
        $this->connector = $connector ?: new HttpConnector((new HttpOptions)->setUserAgent('Porter'));
    }

    public function getConnector(): Connector
    {
        return $this->connector;
    }
}
