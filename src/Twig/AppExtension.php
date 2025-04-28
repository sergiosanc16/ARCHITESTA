<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;

class AppExtension extends AbstractExtension
{
    private Filesystem $filesystem;
    private string $projectDir;

    public function __construct(Filesystem $filesystem, ParameterBagInterface $params)
    {
        $this->filesystem = $filesystem;
        $this->projectDir = $params->get('kernel.project_dir');
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_exists', [$this, 'assetExists']),
        ];
    }

    public function assetExists(string $assetPath): bool
    {
        $fullPath = $this->projectDir . '/public/' . ltrim($assetPath, '/');
        return $this->filesystem->exists($fullPath);
    }
}
