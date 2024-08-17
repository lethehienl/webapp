<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    App\Bundle\AdminBundle\AdminBundle::class => ['all' => true],
    App\Bundle\HtmlBundle\HtmlBundle::class => ['all' => true],
    App\Bundle\HomeBundle\HomeBundle::class => ['all' => true],
];
