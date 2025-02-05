<?php
namespace App\Bundle\AgentBundle;
use App\Bundle\AgentBundle\DependencyInjection\AgentExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
class AgentBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new AgentExtension();
    }
}