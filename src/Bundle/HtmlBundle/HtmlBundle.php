<?php
namespace App\Bundle\HtmlBundle;
use App\Bundle\HtmlBundle\DependencyInjection\HtmlExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
class HtmlBundle extends AbstractBundle
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