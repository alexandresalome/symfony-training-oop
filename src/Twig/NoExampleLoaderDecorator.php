<?php

namespace App\Twig;

use Twig\Loader\LoaderInterface;
use Twig\Source;

class NoExampleLoaderDecorator implements LoaderInterface
{
    /**
     * @var LoaderInterface
     */
    private LoaderInterface $loader;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function getSourceContext(string $name): Source
    {
        $origin = $this->loader->getSourceContext($name);
        $code = strtr($origin->getCode(), [
            'Hello' => 'Coucou',
            'Registrations' => 'Inscriptions',
        ]);

        return new Source($code, $origin->getName(), $origin->getPath());
    }

    public function getCacheKey(string $name): string
    {
        return $this->loader->getCacheKey($name).'x';
    }

    public function isFresh(string $name, int $time): bool
    {
        return $this->loader->isFresh($name, $time);
    }

    public function exists(string $name)
    {
        return $this->loader->exists($name);
    }
}
