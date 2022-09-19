<?php

namespace Pureware\TemplateGenerator\TreeBuilder\Directory;

use Pureware\TemplateGenerator\TreeBuilder\File\FileCollection;

interface DirectoryInterface
{

    public function getName(): string;

    public function setName(string $name): self;

    public function setFiles(FileCollection $files): self;

    public function getFiles(): FileCollection;

    public function setDirectories(DirectoryCollection $directories): self;

    public function getDirectories(): ?DirectoryCollection;
}
