<?php

namespace Pureware\TemplateGenerator\TreeBuilder\Directory;

use Pureware\TemplateGenerator\TreeBuilder\File\File;
use Pureware\TemplateGenerator\TreeBuilder\File\FileCollection;
use Pureware\TemplateGenerator\TreeBuilder\File\FileInterface;


class DirectoryCollection extends \Illuminate\Support\Collection
{
    protected FileCollection $files;


    /**
     * @return FileCollection
     */
    public function getFiles(): ?FileCollection
    {
        $fileCollection = new FileCollection();

        if (!$this->items) {
            return $fileCollection;
        }

        
        foreach ($this->items as $directory) {
            $fileCollection = $fileCollection->merge($directory->getFiles()->all());
        }

        return $fileCollection;

    }

    public function setFiles(FileCollection $files): void
    {
        $this->files = $files;
    }

    public function addFile(FileInterface $file): void
    {
        $this->files->add($file);
    }

    public function getDirectories(): ?DirectoryCollection
    {
        return $this->items;
    }

    public function setDirectories(?DirectoryCollection $directories): void
    {
        $this->items = $directories;
    }

    public function addDirectories(DirectoryInterface $directory): void
    {
        $this->directories->add($directory);
    }
    
}
