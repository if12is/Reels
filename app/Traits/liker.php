<?php

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable
{
    // use Liker;
}
