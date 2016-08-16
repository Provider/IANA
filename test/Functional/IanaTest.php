<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana\Functional;

use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;

abstract class IanaTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = (new Porter)->registerProvider(new IanaProvider);
    }
}
