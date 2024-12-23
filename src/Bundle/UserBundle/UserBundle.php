<?php

    namespace App\Bundle\UserBundle;

    use App\Bundle\HtmlBundle\DependencyInjection\HtmlExtension;
    use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
    use Symfony\Component\HttpKernel\Bundle\Bundle;
    use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

    class UserBundle extends AbstractBundle
    {
        public function getPath(): string
        {
            return __DIR__;
        }

        public function getContainerExtension(): ?ExtensionInterface
        {
            return new HtmlExtension();
        }
    }