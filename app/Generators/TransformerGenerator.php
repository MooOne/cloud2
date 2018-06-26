<?php

namespace Yeelight\Generators;

/**
 * Class TransformerGenerator
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
class TransformerGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'transformer/transformer';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace() .
            parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'transformers';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() .
            '/' .
            parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) .
            '/' .
            $this->getName() .
            'Transformer.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('repository.generator.basePath', app_path());
    }

    /**
     * Get default Columns description.
     *
     * @return string
     */
    public function getColumns()
    {
        $fields = $this->fields;
        $result = '';
        if (!empty($fields)) {
            foreach ($fields as $index => $field) {
                $type = $this->getTypeFromField($field);
                $result .= "\t\t\t'{$field['name']}' => ($type) ".'$model->'."{$field['name']},\r\n";
            }
        }
        $result .= '';

        return $result;
    }

    private function getTypeFromField($filed)
    {
        switch ($filed['type']) {
            case 'string':
            case 'text':
            case 'date':
            case 'time':
            case 'dateTime':
            case 'timestamp':
            case 'char':
            case 'mediumText':
            case 'longText':
            case 'enum':
            case 'json':
            case 'jsonb':
            case 'dateTimeTz':
            case 'timeTz':
            case 'timestampTz':
            case 'nullableTimestamps':
            case 'binary':
            case 'ipAddress':
            case 'macAddress':
                return 'string';

            case 'integer':
            case 'tinyInteger':
            case 'smallInteger':
            case 'mediumInteger':
            case 'bigInteger':
            case 'unsignedTinyInteger':
            case 'unsignedSmallInteger':
            case 'unsignedMediumInteger':
            case 'unsignedInteger':
            case 'unsignedBigInteger':
                return 'int';

            case 'float':
            case 'decimal':
                return 'float';

            case 'double':
                return 'double';

            case 'boolean':
                return 'boolean';
        }
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $modelGenerator = new ModelGenerator(
            [
                'name' => $this->name,
            ]
        );
        $model = $modelGenerator->getRootNamespace().'\\'.$modelGenerator->getName();
        $model = str_replace([
            '\\',
            '/',
        ], '\\', $model);

        return array_merge(
            parent::getReplacements(),
            [
                'model' => $model,
                'transformer_fields' => $this->getColumns(),
                '_id_name' => $this->getIdName(),
            ]
        );
    }
}
