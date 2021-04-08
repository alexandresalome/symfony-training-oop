<?php


namespace App\Messenger;


use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\TransportException;
use Symfony\Component\Messenger\Transport\TransportInterface;

class FileDirectoryTransport implements TransportInterface
{
    public function get(): iterable
    {
        dd(__METHOD__);
    }

    public function ack(Envelope $envelope): void
    {
        dd(__METHOD__);
    }

    public function reject(Envelope $envelope): void
    {
        dd(__METHOD__);
    }

    public function send(Envelope $envelope): Envelope
    {
        dd(__METHOD__);
    }
}
