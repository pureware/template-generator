<?php

namespace Pureware\TemplateGenerator\TreeBuilder\Directory;



use Pureware\TemplateGenerator\TreeBuilder\File\FileCollection;

class Directory implements DirectoryInterface
{
    protected string $name;

    protected FileCollection $files;

    protected ?DirectoryCollection $directories = null;

    public function __construct(string $name) {
        $this->name = $name;
        $this->files = new FileCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DirectoryInterface
    {
        $this->name = $name;

        return $this;
    }

    public function setFiles(FileCollection $files): DirectoryInterface
    {
        $this->files = $files;

        return $this;
    }

    public function getFiles(): FileCollection
    {
        return $this->files;
    }

    public function setDirectories(DirectoryCollection $directories): DirectoryInterface
    {
        $this->directories = $directories;

        return $this;
    }

    public function getDirectories(): ?DirectoryCollection
    {
        return $this->directories;
    }
}
