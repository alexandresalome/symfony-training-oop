<?php

namespace App\Messenger;

use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Messenger\Transport\TransportFactoryInterface;
use Symfony\Component\Messenger\Transport\TransportInterface;

class FileDirectoryAdapterFactory implements TransportFactoryInterface
{

    public function createTransport(string $dsn, array $options, SerializerInterface $serializer): TransportInterface
    {
        return new FileDirectoryTransport();
    }

    public function supports(string $dsn, array $options): bool
    {
        return $dsn === 'ouioui-cer-formation';
    }
}
