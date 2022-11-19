<?php

namespace Pureware\TemplateGenerator\TreeBuilder\File;

class File implements FileInterface
{

    protected string $name;
    
    protected string $fileNamespace;

    protected string $content = '';

    protected string $parsedFileName;

    protected string $parsedFileContent = '';

    public function __construct(string $name, $fileNamespace)
    {
        $this->name = $name;
        $this->fileNamespace = $fileNamespace;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getParsedFileContent(): string
    {
        return $this->parsedFileContent;
    }

    public function setParsedFileContent(string $parsedFileContent): void
    {
        $this->parsedFileContent = $parsedFileContent;
    }

    public function getParsedFileName(): string
    {
        return $this->parsedFile ?? $this->getName();
    }

    public function setParsedFileName(string $parsedFileName): void
    {
        $this->parsedFile = $parsedFileName;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFileNamespace(): string
    {
        return $this->fileNamespace;
    }

    public static function createFromSpl(\SplFileInfo $fileInfo, string $relativeFilePath, string $namespace): self {
        $new = new self($relativeFilePath, rtrim($namespace, '\\'));
        $new->setContent(file_get_contents($fileInfo->getRealPath()));
        return $new;
    }

}
