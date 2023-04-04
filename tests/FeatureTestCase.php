<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\Asserts;
use Tests\Traits\SignIn;

class FeatureTestCase extends TestCase
{
    use SignIn,
        Asserts,
        DatabaseTransactions;
}
