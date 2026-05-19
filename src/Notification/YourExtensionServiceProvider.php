<?php 

namespace FoF\IgnoreUsers\Notification;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Notification\NotificationSyncer;

class YourExtensionServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->container->extend(NotificationSyncer::class, function ($original, $app) {
            return new FilteringNotificationSyncer($original);
        });
    }
}
