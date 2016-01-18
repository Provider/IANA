<?php
namespace ScriptFUSION\Porter\Provider\Iana;

use ScriptFUSION\Porter\Provider\ProviderName;

class IanaProviderName implements ProviderName
{
    public function __toString()
    {
        return 'IANA';
    }
}
