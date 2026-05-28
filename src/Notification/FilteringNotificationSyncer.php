<?php

namespace FoF\IgnoreUsers\Notification;

use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\User as FlarumUser;

class FilteringNotificationSyncer extends NotificationSyncer
{
    public function __construct(private NotificationSyncer $inner) {}

    public function sync(BlueprintInterface $blueprint, array $users): void
    {
        $users = array_filter($users, fn($user) => !$this->isSuppressed($blueprint, $user));
        $this->inner->sync($blueprint, $users);
    }

    private function isSuppressed(BlueprintInterface $blueprint, FlarumUser $user): bool
    {
        // suppress the notification if the from user is in the user's ignored users list
        return in_array($blueprint->getFromUser()->id, $user->ignoredUsers()->pluck('id')->all());
    }
}
