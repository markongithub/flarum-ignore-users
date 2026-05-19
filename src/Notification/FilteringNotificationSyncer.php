<?php 

namespace FoF\IgnoreUsers\Notification;

use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\NotificationSyncer;

class FilteringNotificationSyncer extends NotificationSyncer
{
    public function __construct(private NotificationSyncer $inner) {}

    public function sync(BlueprintInterface $blueprint, array $users): void
    {
        $users = array_filter($users, fn($user) => !$this->isSuppressed($blueprint, $user));
        $this->inner->sync($blueprint, $users);
    }

    private function isSuppressed(BlueprintInterface $blueprint, $user): bool
    {
        error_log("called isSuppressed for subject " . $blueprint->getSubject());
        return false;
    }
}