<?php

namespace Pureware\TemplateGenerator\Parser;

use Pureware\TemplateGenerator\TreeBuilder\File\File;
use Twig\Environment;
use Twig\Error\{LoaderError, SyntaxError};
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

class TwigParser implements ParserInterface
{
    private Environment $twig;
    private array $templateData;

    public function __construct() {
        $this->twig = new Environment(new FilesystemLoader(__DIR__));
        $this->twig->addExtension(new StringExtension());
        $this->twig->enableStrictVariables();
    }

    public function setTemplateData(array $data): void
    {
        $this->templateData = $data;
    }

    public function parseFile(File $file): File
    {

        try {
            $file->setParsedFileContent($this->parseString($file->getContent()));
            $file->setParsedFileName($this->parseString($file->getName()));

        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Could not parse string template. See Error: %s', $e->getMessage()));
        }

        return $file;
    }

    /**
     * @param string $string
     * @return string
     * @throws LoaderError
     * @throws SyntaxError
     */
    public function parseString(string $string): string
    {
        $template = $this->twig->createTemplate($string);
        return $template->render($this->templateData);
    }
}
