# PHP based template generator with twig templates
A php based template generator for files of every language. Pass a directory with template files, pass variables for template and create files in a given destination.

## Install
```
composer require pureware/template-generator
```

## General Usage

### Twig Parser
First pass the template variables with values to the twig parser
```php
$parser = new Pureware\TemplateGenerator\Parser\TwigParser();
$parser->setTemplateData(
    [
        'data' => 'value',
    ]
);
```

### Tree builder
Then create a virtual files Tree. You can create a new directory or leave it empty.
```php 
$treeBuilder = new Pureware\TemplateGenerator\TreeBuilder\TreeBuilder();
$files = $treeBuilder->buildTree('../templates', 'YourNewDirectory'); // your templates
```

### Templates generator
Pass the files and directories you want to create to the template generator
``` php
$generator = new DirectoryGenerator('destination/path/for/your/new/files/YourNewDirectory, $parser);
$generator->setForce(true); //allows you to overrite already existing files
$generator->generate($files);
```


## Templates
Basically you can use default twig syntax

### Change string case
The twig environment uses the symfony `UnicodeString` extension: https://github.com/twigphp/string-extra

camelCase
```twig
{{value|u.camel}}
```

PascalCase
```twig
{{value|u.camel.title}}
```

Snake
```twig
{{value|u.snake}}
```
