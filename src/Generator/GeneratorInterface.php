<?php

namespace Pureware\TemplateGenerator\Generator;

use Pureware\TemplateGenerator\Parser\ParserInterface;
use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;
use Pureware\TemplateGenerator\TreeBuilder\Directory\DirectoryCollection;

interface GeneratorInterface
{

    public function __construct(string $destinationPath, ParserInterface $parser);

    public function setForce(bool $force = true);

    public function getForce(): bool;

    public function generate(Directory $directory);

    public function getParser(): ParserInterface;
}
