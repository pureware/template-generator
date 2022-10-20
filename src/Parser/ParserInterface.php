<?php
namespace Pureware\TemplateGenerator\Parser;

use Pureware\TemplateGenerator\TreeBuilder\File\File;

interface ParserInterface
{
    public function setTemplateData(array $data): void;

    public function addTemplateData(string $key, $value): void;

    public function parseFile(File $file): File;

    public function parseString(string $string): string;
}
