<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana;

use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Iana\IanaProvider;

abstract class IanaTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = (new Porter)->addProvider(new IanaProvider);
    }
}
