<?php

namespace Pureware\TemplateGenerator\Generator;

use Pureware\TemplateGenerator\Parser\ParserInterface;
use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;
use Pureware\TemplateGenerator\TreeBuilder\File\File;
use Pureware\TemplateGenerator\TreeBuilder\File\FileCollection;
use Symfony\Component\Filesystem\Filesystem;

class DirectoryGenerator implements GeneratorInterface
{
    protected ParserInterface $parser;
    protected Filesystem $filesystem;
    protected string $destinationPath;
    protected bool $force = false;

    public function __construct(string $destinationPath, ParserInterface $parser)
    {
        $this->destinationPath = $destinationPath;
        $this->parser = $parser;

        $this->filesystem = new Filesystem();
    }


    public function setForce(bool $force = true)
    {
        $this->force = $force;
    }

    public function getForce(): bool
    {
        return $this->force;
    }

    public function generate(Directory $directory)
    {
        if (!$this->filesystem->exists($this->destinationPath)) {
            $this->filesystem->mkdir($this->destinationPath);
        }

        $this->parseTemplates($directory);
        /** @var File $file */
        foreach ($this->getFiles($directory) as $file) {
            $this->filesystem->dumpFile($this->buildFilePath($file), $file->getParsedFileContent());
        }
    }

    protected function getFiles(Directory $directory): FileCollection {
        if ($this->force) {
            $files = $directory->getFiles();
        } else {
            $files = $directory->getFiles()->filter(fn(File $file) => !$this->filesystem->exists($this->buildFilePath($file)));
        }


        if ($directory->getDirectories()) {
            /** @var Directory $dir */
            foreach ($directory->getDirectories() as $dir) {
                $dirPath = $this->buildDirPath($dir);
                if (!$this->filesystem->exists($dirPath)) {
                    $this->filesystem->mkdir($dirPath);
                }
                $files = $files->merge($this->getFiles($dir));
            }

        }

        return $files;
    }

    protected function parseTemplates(Directory $directory) {
        $directory->getFiles()->each(function (File $file) {
            $this->parser->parseFile($file);
        });

        if ($directory->getDirectories()) {
            $directory->getDirectories()->each(function (Directory $dir) {
                $dir->setName($this->parser->parseString($dir->getName()));
                $this->parseTemplates($dir);
            });
        }
    }

    protected function buildDirPath(Directory $dir): string {
        return $this->destinationPath . DIRECTORY_SEPARATOR . $dir->getName();
    }

    protected function buildFilePath(File $file): string {
        return $this->destinationPath . DIRECTORY_SEPARATOR . $file->getParsedFileName();
    }
    
    public function getParser(): ParserInterface
    {
        return $this->parser;
    }
}
