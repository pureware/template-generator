<?php

namespace Pureware\TemplateGenerator\TreeBuilder\File;

interface FileInterface
{

    public function setName(string $name);

    public function getName(): string;

}
