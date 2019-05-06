<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create($model, $attrib = [])
    {
        return factory($model)->create($attrib);
    }

    public function raw($model, $attrib = [])
    {
        return factory($model)->raw($attrib);
    }
}
