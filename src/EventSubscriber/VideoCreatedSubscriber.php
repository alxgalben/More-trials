<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
        ];
    }
}
