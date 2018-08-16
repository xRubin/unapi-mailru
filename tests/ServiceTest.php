<?php

use PHPUnit\Framework\TestCase;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use unapi\mailru\Service;
use unapi\mailru\Client;
use unapi\mailru\parser\Mailbox;
use unapi\mailru\Credentials;

class UwsfindServiceTest extends TestCase
{
    protected function getService(HandlerStack $handler)
    {
        return new Service([
            'client' => new Client(['handler' => $handler]),
        ]);
    }

    public function testFindDeclarationsByLegal()
    {
        $service = $this->getService(
            HandlerStack::create(
                new MockHandler([
                    new Response(200, [], file_get_contents(__DIR__ . '/responses/init.html')),
                    new Response(200, [], file_get_contents(__DIR__ . '/responses/auth.html')),
                    new Response(200, [], file_get_contents(__DIR__ . '/responses/threads.json')),
                ])
            )
        );

        $credentials = new Credentials('simona.unun.vazhenina@mail.ru', 'password');

        /** @var Mailbox $mailbox */
        $mailbox = $service->getToken($credentials)
            ->then(function (string $token) use ($service, $credentials) {
                return $service->getMailbox($credentials, $token);
            })->wait();

        $this->assertInstanceOf(Mailbox::class, $mailbox);
        $this->assertEquals('simona.unun.vazhenina@mail.ru', $mailbox->getEmail());
        $this->assertEquals(4, $mailbox->getBody()->getMessagesTotal());
    }
}