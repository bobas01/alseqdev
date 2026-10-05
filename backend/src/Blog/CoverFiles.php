<?php

namespace App\Blog;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class CoverFiles
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private string $projectDir,
        private SvgCover $svg,
    ) {
    }

    public function store(string $name, string $svg): bool
    {
        if (preg_match('/^[a-z0-9-]+$/', $name) !== 1 || !$this->svg->accepts($svg)) {
            return false;
        }

        $directory = $this->directory();
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            return false;
        }

        $path = $directory.'/'.$name.'.svg';
        $temporary = $path.'.tmp';
        if (file_put_contents($temporary, $svg) === false) {
            return false;
        }

        return rename($temporary, $path);
    }

    public function read(string $name): ?string
    {
        if (preg_match('/^[a-z0-9-]+$/', $name) !== 1) {
            return null;
        }

        foreach (['/data/blog-covers', $this->projectDir.'/var/blog-covers'] as $directory) {
            $path = $directory.'/'.$name.'.svg';
            if (is_file($path)) {
                $contents = file_get_contents($path);
                if (!is_string($contents) || !$this->svg->accepts($contents)) {
                    return null;
                }

                return $contents;
            }
        }

        return null;
    }

    private function directory(): string
    {
        return is_dir('/data') && is_writable('/data')
            ? '/data/blog-covers'
            : $this->projectDir.'/var/blog-covers';
    }
}
