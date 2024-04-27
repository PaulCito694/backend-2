<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

Broadcast::channel('channel_for_everyone', function (User $user) {
    //var_dump($user->name);
    return [
        'id' => $user->id,
        'name' => $user ->name,
    ];
});

Broadcast::channel('scrum_poker.{id}', function (User $user) {
    //var_dump($user->name);
    return [
        'id' => $user->id,
        'name' => $user ->name,
    ];
});
