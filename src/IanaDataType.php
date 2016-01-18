<?php
namespace ScriptFUSION\Porter\Provider\Iana;

use ScriptFUSION\Porter\Provider\ProviderDataType;

class IanaDataType implements ProviderDataType
{
    const PORT_NUMBERS = 'PORT_NUMBERS';
    const ROOT_ZONES = 'ROOT_ZONES';

    private $type;

    public function __construct($type)
    {
        $this->type = "$type";
    }

    public function getName()
    {
        return new IanaProviderName;
    }

    public function __toString()
    {
        return "$this->type";
    }
}
