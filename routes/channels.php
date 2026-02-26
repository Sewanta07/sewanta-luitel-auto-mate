<?php

use App\Support\Realtime\ChatUserResolver;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['web', 'multi.auth']]);

Broadcast::channel('App.Models.User.{id}', function ($authUser, int $id) {
    $systemUser = ChatUserResolver::fromAuthenticatable($authUser);

    return $systemUser->id === $id;
});

Broadcast::channel('dashboard.admin', function ($authUser) {
    $systemUser = ChatUserResolver::fromAuthenticatable($authUser);

    return $systemUser->role === 'admin';
});

Broadcast::channel('chat.{leftUserId}.{rightUserId}', function ($authUser, int $leftUserId, int $rightUserId) {
    $systemUser = ChatUserResolver::fromAuthenticatable($authUser);

    if ($systemUser->role === 'admin') {
        return true;
    }

    return in_array($systemUser->id, [$leftUserId, $rightUserId], true);
});
