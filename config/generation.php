<?php

return collect([
    'outline/arrows',
    'outline/e-commerce',
    'outline/emoji',
    'outline/file-folders',
    'outline/general',
    'outline/media',
    'outline/text',
    'outline/user',
    'outline/weather',
    'solid/arrows',
    'solid/e-commerce',
    'solid/emoji',
    'solid/file-folders',
    'solid/general',
    'solid/media',
    'solid/text',
    'solid/user',
    'solid/weather',
    'solid/brands',
])->transform(fn ($source) => [
    'source' => __DIR__.'/../svg_temp/'.$source,
    'destination' => __DIR__.'/../resources/svg',
    'output-prefix' => \Illuminate\Support\Str::of($source)->startsWith('outline') ? 'o-' : 's-',
    'safe' => true,
    'after' => static function (string $icon, array $config, SplFileInfo $file) {
        $fileContents = file_get_contents($icon);
        $fileContents = str_replace('fill="#2F2F38" ', '', $fileContents);
        $fileContents = str_replace('fill="#2F2F38"', '', $fileContents);
        if($config['output-prefix'] === 's-') {
            $fileContents = str_replace('fill="none"', 'fill="currentColor"', $fileContents);
        }
        file_put_contents($icon, $fileContents);
    },
])->toArray();
