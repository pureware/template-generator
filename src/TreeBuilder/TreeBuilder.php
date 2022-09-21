<?php

namespace Pureware\TemplateGenerator\TreeBuilder;

use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;
use Pureware\TemplateGenerator\TreeBuilder\Directory\DirectoryCollection;
use Pureware\TemplateGenerator\TreeBuilder\File\File;
use Pureware\TemplateGenerator\TreeBuilder\File\FileCollection;
use Symfony\Component\Finder\Finder;

class TreeBuilder implements TreeBuilderInterface
{

    public function buildTree(string $path, ?string $entryDirectoryName = null): Directory
    {
        $directory = new Directory($entryDirectoryName);
        $directory->setFiles($this->getFiles(realpath($path)));
        $directory->setDirectories($this->getDirectories(realpath($path)));

        return $directory;
    }

    private function getDirectories(string $path, string $parentPath = ''): DirectoryCollection {
        $directoryCollection = new DirectoryCollection();
        $finder = Finder::create()
            ->in($path)
            ->depth(0);

        if ($finder->count() === 0) {
            return $directoryCollection;
        }

        foreach ($finder->directories() as $dir) {
            $relativeDirPath = sprintf('%s%s%s', $parentPath, $parentPath === '' ? '' : DIRECTORY_SEPARATOR, $dir->getFilename());
            $directory = new Directory($relativeDirPath);
            $directory->setDirectories($this->getDirectories($dir->getRealPath(), $relativeDirPath));
            $directory->setFiles($this->getFiles($dir->getRealPath(), $relativeDirPath));
            $directoryCollection->add($directory);
        }
        return $directoryCollection;
    }

    private function getFiles(string $path, string $parentPath = ''): FileCollection
    {
        $fileCollection = new FileCollection();
        $finder = Finder::create()
            ->in($path)
            ->ignoreDotFiles(false)
            ->depth(0);
        foreach ($finder->files() as $file) {
            $fileCollection->add(File::createFromSpl($file, $parentPath));
        }
        return $fileCollection;
    }
}
