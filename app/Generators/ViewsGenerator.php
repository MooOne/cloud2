<?php
namespace Yeelight\Generators;

use Illuminate\Support\Str;
use League\Flysystem\FileNotFoundException;

/**
 * Class ViewsGenerator
 * @package Yeelight\Generators
 */

class ViewsGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = '';

    /**
     * Get the views array
     * @var array
     */
    protected $views = [
        'index' => 'index.blade.php',
        'create' => 'create.blade.php',
        'edit' => 'edit.blade.php',
    ];


    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return '';
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'views';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . '/';
    }

    /**
     * Get name input.
     *
     * @return string
     */
    public function getName()
    {
        $name = $this->name;
        if (str_contains($this->name, '\\')) {
            $name = str_replace('\\', '/', $this->name);
        }
        if (str_contains($this->name, '/')) {
            $name = str_replace('/', '/', $this->name);
        }

        return Str::plural(Str::snake(str_replace(' ', '/', ucwords(str_replace('/', ' ', $name)))));
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return resource_path('views');
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'model' => $this->getName()
        ]);
    }

    /**
     * Run the generator.
     * @throws FileAlreadyExistsException
     * @throws FileNotFoundException
     */
    public function run()
    {
        foreach ($this->views as $index => $view) {
            if ($this->filesystem->exists($path = $this->getPath() . $view) && !$this->force) {
                throw new FileAlreadyExistsException($path);
            }

            if (!$this->filesystem->isDirectory($dir = dirname($path))) {
                $this->filesystem->makeDirectory($dir, 0777, true, true);
            }

            $stubsOverridePath = config('repository.generator.stubsOverridePath', __DIR__);

            if (!file_exists($stubsOverridePath . "/Stubs/views/{$index}.stub")) {
                $stubsOverridePath = __DIR__;
            }

            if (!file_exists($stubsOverridePath . "/Stubs/views/{$index}.stub")) {
                throw new FileNotFoundException($stubsOverridePath . "/Stubs/views/{$index}.stub");
            }

            $this->stub = 'views/' . $index;

            $this->filesystem->put($path, $this->getStub());
        }
    }
}
