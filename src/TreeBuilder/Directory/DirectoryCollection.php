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

    /**
     * @param FileCollection $files
     */
    public function setFiles(FileCollection $files): void
    {
        $this->files = $files;
    }

    /**
     * @param FileInterface $file
     * @return void
     */
    public function addFile(FileInterface $file): void
    {
        $this->files->add($file);
    }

    /**
     * @return DirectoryCollection|null
     */
    public function getDirectories(): ?DirectoryCollection
    {
        return $this->items;
    }

    /**
     * @param DirectoryCollection|null $directories
     */
    public function setDirectories(?DirectoryCollection $directories): void
    {
        $this->items = $directories;
    }

    /**
     * @param DirectoryInterface $directory
     * @return void
     */
    public function addDirectories(DirectoryInterface $directory): void
    {
        $this->directories->add($directory);
    }
    
}
