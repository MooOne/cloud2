<?php

namespace Yeelight\Generators;

use Yeelight\Generators\Migrations\SchemaParser;

/**
 * Class RepositoryEloquentGenerator
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
class RepositoryEloquentGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'repository/eloquent';

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
        return 'repositories';
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
            'RepositoryEloquent.php';
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
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $repository = parent::getRootNamespace().parent::getConfigGeneratorClassPath('interfaces').'\\'.$this->name.'Repository;';
        $repository = str_replace(
            [
                '\\',
                '/',
            ],
            '\\',
            $repository
        );

        return array_merge(
            parent::getReplacements(),
            [
                'fillable' => $this->getFillable(),
                'searchable' => $this->getSearchable(),
                'use_validator' => $this->getValidatorUse(),
                'validator' => $this->getValidatorMethod(),
                'use_presenter' => $this->getPresenterUse(),
                'root_namespace' => parent::getRootNamespace(),
                'presenter' => $this->getPresenterMethod(),
                'repository' => $repository,
                'model' => isset($this->options['model']) ? $this->options['model'] : '',
            ]
        );
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        if (!$this->fillable) {
            return '[]';
        }
        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value) {
            $results .= "\t\t'{$column}',".PHP_EOL;
        }

        return $results."\t".']';
    }

    /**
     * Get the Searchable attributes.
     *
     * @return string
     */
    public function getSearchable()
    {
        if (!$this->fields) {
            return '[]';
        }
        $results = '['.PHP_EOL;

        foreach ($this->fields as $column => $field) {
            $results .= $this->getSearchAbleFromField($field);
        }

        return $results."\t".']';
    }

    private function getSearchAbleFromField($field)
    {
        switch ($field['type']) {
            case 'string':
            case 'text':
            case 'char':
            case 'mediumText':
            case 'longText':
            case 'enum':
            case 'json':
            case 'jsonb':
            case 'binary':
            case 'ipAddress':
            case 'macAddress':
                return "\t\t'{$field['name']}' => 'like'," . PHP_EOL;
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
            case 'date':
            case 'time':
            case 'dateTime':
            case 'timestamp':
            case 'dateTimeTz':
            case 'timeTz':
            case 'timestampTz':
            case 'nullableTimestamps':
            case 'float':
            case 'decimal':
            case 'double':
            case 'boolean':
                return "\t\t'{$field['name']}'," . PHP_EOL;
        }
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fillable);
    }

    /**
     * GetValidatorUse
     *
     * @return string
     */
    public function getValidatorUse()
    {
        $validator = $this->getValidator();

        return "use {$validator};";
    }

    /**
     * GetValidator
     *
     * @return string
     */
    public function getValidator()
    {
        $validatorGenerator = new ValidatorGenerator(
            [
                'name' => $this->name,
                'rules' => $this->rules,
                'force' => $this->force,
            ]
        );

        $validator = $validatorGenerator->getRootNamespace().'\\'.$validatorGenerator->getName();

        return str_replace([
            '\\',
            '/',
        ], '\\', $validator).'Validator';
    }

    /**
     * GetValidatorMethod
     *
     * @return string
     */
    public function getValidatorMethod()
    {
        if ($this->validator != 'yes') {
            return '';
        }

        $class = $this->getClass();

        return '/**'.PHP_EOL.'    * Specify Validator class name'.PHP_EOL.'    *'.PHP_EOL.'    * @return mixed'.PHP_EOL.'    */'.PHP_EOL.'    public function validator()'.PHP_EOL.'    {'.PHP_EOL.PHP_EOL.'        return '.$class.'Validator::class;'.PHP_EOL.'    }'.PHP_EOL;
    }

    /**
     * GetPresenterUse
     *
     * @return string
     */
    public function getPresenterUse()
    {
        $presenter = $this->getPresenter();

        return "use {$presenter};";
    }

    /**
     * GetPresenter
     *
     * @return string
     */
    public function getPresenter()
    {
        $presenterGenerator = new PresenterGenerator(
            [
                'name' => $this->name,
                'rules' => $this->rules,
                'force' => $this->force,
            ]
        );

        $presenter = $presenterGenerator->getRootNamespace().'\\'.$presenterGenerator->getName();

        return str_replace([
            '\\',
            '/',
        ], '\\', $presenter).'Presenter';
    }

    /**
     * GetPresenterMethod
     *
     * @return string
     */
    public function getPresenterMethod()
    {
        if ($this->presenter != 'yes') {
            return '';
        }

        $class = $this->getClass();

        return '/**'.PHP_EOL.'    * Specify Presenter class name'.PHP_EOL.'    *'.PHP_EOL.'    * @return mixed'.PHP_EOL.'    */'.PHP_EOL.'    public function presenter()'.PHP_EOL.'    {'.PHP_EOL.PHP_EOL.'        return '.$class.'Presenter::class;'.PHP_EOL.'    }'.PHP_EOL;
    }
}
