<?php

namespace Tests\Traits;

use App\Models\User;

trait SignIn
{
    public function signIn($user = null)
    {
        if (is_null($user)) {
            // $user = factory(User::class)->create();
            $user = User::factory()->create();
        }

        $this->be($user);

        return $user;
    }
}
