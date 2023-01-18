<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ViteAssetExtension extends AbstractExtension
{
    private ?array $manifestData = null;

    public function __construct(
        private bool $isDev,
        private string $manifest,
        )
    {
        
    }

    public function getFunctions() : array
    {
        return[
            new TwigFunction('vite_asset', [$this, 'asset'], ['is_safe' => ['html']])
        ];
    }

    public function asset(string $entry){
        if($this -> isDev){
            return $this->assetDev($entry);
        }
        return $this->assetProd($entry);
    }

    public function assetDev(string $entry) : string
    {
        $html = <<<HTML
        <script type="module" src="http://127.0.0.1:5173/assets/@vite/client"></script>
        HTML;

        $html .= <<<HTML
        <script type="module" src="http://127.0.0.1:5173/assets/{$entry}" defer></script>
        HTML;

        return $html;
    }

    public function assetProd(string $entry) : string
    {
        $data = json_decode(file_get_contents($this->manifest), true);
        $file = $data[$entry]['file'];
        $css = $data[$entry]['css'];
        //$imports = $data[$entry]['imports'];
        $html = <<<HTML
        <script type="module" src="/assets/{$file}" defer></script>
        HTML;

        foreach($css as $cssFile){
            $html .= <<<HTML
            <link rel="stylesheet" media="screen" href="/assets/{$cssFile}"/>
            HTML;
        }

        return $html;
    }

}