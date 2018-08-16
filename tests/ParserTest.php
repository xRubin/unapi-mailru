<?php

use PHPUnit\Framework\TestCase;

use unapi\mailru\parser\Mailbox;

class ParserTest extends TestCase
{
    public function testParseThreads()
    {
        $mailbox = new Mailbox(file_get_contents(__DIR__ . '/responses/threads.json'));

        $this->assertEquals('simona.unun.vazhenina@mail.ru', $mailbox->getEmail());
        $this->assertEquals(4, $mailbox->getBody()->getMessagesTotal());

        $threads = $mailbox->getBody()->getThreads();

        $this->assertEquals(4, count($threads));
        $this->assertEquals('Все для общения в Агенте Mail.Ru', $threads['1:0d356d30519e073b:0']->getSubject());
    }
}