<?php

namespace Pureware\TemplateGenerator\Generator;

use Pureware\TemplateGenerator\TreeBuilder\Directory\Directory;
use Pureware\TemplateGenerator\TreeBuilder\File\File;

class FilesGenerator extends DirectoryGenerator
{

    public function generate(Directory $directory)
    {
        $this->parseTemplates($directory);
        /** @var File $file */
        foreach ($this->getFiles($directory) as $file) {
            $this->filesystem->dumpFile($this->buildFilePath($file), $file->getParsedFileContent());
        }
    }
}
