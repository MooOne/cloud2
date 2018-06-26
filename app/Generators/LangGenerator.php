<?php

namespace Yeelight\Generators;

use Illuminate\Support\Str;
use League\Flysystem\FileNotFoundException;

/**
 * Class LangGenerator
 *
 * @category Yeelight
 *
 * @package Yeelight\Generators
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class LangGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'lang/lang';

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
        return 'lang';
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

        return Str::plural(
            Str::snake(
                str_replace(' ', '/', ucwords(str_replace('/', ' ', $name)))
            )
        );
    }

    /**
     * Get default header.
     *
     * @return string
     */
    public function getHeader()
    {
        $name = $this->name;
        if (str_contains($this->name, '\\')) {
            $name = str_replace('\\', '/', $this->name);
        }
        if (str_contains($this->name, '/')) {
            $name = str_replace('/', '/', $this->name);
        }

        return ucwords(str_replace(['/', '-', '_'], ' ', $name));
    }

    /**
     * Get default Columns description.
     *
     * @return string
     */
    public function getColumns()
    {
        $fields = $this->fields;
        $result = "[\r\n";
        $result .= "\t\t'".$this->getIdName()."' => '".str_singular($this->getIdName())."',\r\n";
        if (!empty($fields)) {
            foreach ($fields as /*$index =>*/
                     $field) {
                $result .= "\t\t'{$field['name']}' => '{$field['comment']}',\r\n";
            }
            $result .= "\t\t'created_by' => 'CREATED_BY',\r\n";
            $result .= "\t\t'created_at' => 'CREATED_AT',\r\n";
            $result .= "\t\t'created_ip' => 'CREATED_IP',\r\n";
            $result .= "\t\t'updated_by' => 'UPDATED_BY',\r\n";
            $result .= "\t\t'updated_at' => 'UPDATED_AT',\r\n";
            $result .= "\t\t'updated_ip' => 'UPDATED_IP',\r\n";
        }
        $result .= "\t]";

        return $result;
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return resource_path('lang');
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(
            parent::getReplacements(),
            [
                'model' => $this->getHeader(),
                'model_fields' => $this->getColumns(),
            ]
        );
    }

    /**
     * Run the generator.
     *
     * @throws FileAlreadyExistsException
     * @throws FileNotFoundException
     *
     * @return void
     */
    public function run()
    {
        $directories = $this->filesystem->directories($this->getBasePath());

        foreach ($directories as $index => $directory) {
            if ($this->filesystem->exists($path = $directory.'/'.$this->getName().'.php') && !$this->force) {
                throw new FileAlreadyExistsException($path);
            }

            $stubsOverridePath = config('repository.generator.stubsOverridePath', __DIR__);

            if (!file_exists($stubsOverridePath.'/Stubs/lang/lang.stub')) {
                $stubsOverridePath = __DIR__;
            }

            if (!file_exists($stubsOverridePath.'/Stubs/lang/lang.stub')) {
                throw new FileNotFoundException($stubsOverridePath.'/Stubs/lang/lang.stub');
            }

            $this->filesystem->put($path, $this->getStub());
        }
    }
}
