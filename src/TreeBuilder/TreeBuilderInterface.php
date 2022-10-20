<?php

namespace Pureware\TemplateGenerator\TreeBuilder;

use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;

interface TreeBuilderInterface
{

    public function skip(array $paths): void;
    
    public function buildTree(string $path, string $baseNamespace, ?string $entryDirectoryName = null): Directory;

}
