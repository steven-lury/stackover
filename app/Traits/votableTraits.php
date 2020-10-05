<?php

namespace App\Traits;

use App\Models\User;

trait VotableTraits {

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

}
