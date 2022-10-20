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

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getParsedFileContent(): string
    {
        return $this->parsedFileContent;
    }

    /**
     * @param string $parsedFileContent
     */
    public function setParsedFileContent(string $parsedFileContent): void
    {
        $this->parsedFileContent = $parsedFileContent;
    }

    /**
     * @return string
     */
    public function getParsedFileName(): string
    {
        return $this->parsedFile ?? $this->getName();
    }

    /**
     * @param string $parsedFileName
     */
    public function setParsedFileName(string $parsedFileName): void
    {
        $this->parsedFile = $parsedFileName;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
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
