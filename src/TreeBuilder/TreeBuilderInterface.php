<?php

namespace Pureware\TemplateGenerator\TreeBuilder;

use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;

interface TreeBuilderInterface
{

    public function buildTree(string $path, ?string $entryDirectoryName = null): Directory;

}
