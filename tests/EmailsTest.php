<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class EmailsTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $client->enableProfiler();
        $crawler = $client->request('GET', '/home');

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
