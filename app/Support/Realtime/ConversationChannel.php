<?php

namespace App\Support\Realtime;

class ConversationChannel
{
    public static function fromUserIds(int $firstUserId, int $secondUserId): string
    {
        [$left, $right] = self::orderedPair($firstUserId, $secondUserId);

        return $left.'.'.$right;
    }

    public static function orderedPair(int $firstUserId, int $secondUserId): array
    {
        return $firstUserId < $secondUserId
            ? [$firstUserId, $secondUserId]
            : [$secondUserId, $firstUserId];
    }
}
