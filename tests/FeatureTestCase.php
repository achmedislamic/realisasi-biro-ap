<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\{Asserts, SignIn};

class FeatureTestCase extends TestCase
{
    use SignIn;
    use Asserts;
    use DatabaseTransactions;
}
