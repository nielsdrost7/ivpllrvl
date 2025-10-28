<?php

namespace Modules\Core\tests\Feature;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

abstract class AbstractTestCase extends BaseTestCase
{
    use CreatesApplication;
}
