<?php
namespace App\Bundle\AppBundle;
use App\Bundle\AppBundle\DependencyInjection\AppExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
class AppBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new AppExtension();
    }
}