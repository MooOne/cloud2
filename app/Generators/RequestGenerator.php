<?php

namespace Yeelight\Generators;

/**
 * Class RequestGenerator
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
class RequestGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'request/request';

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
        return 'requests';
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
            'Request.php';
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
    public function getRules()
    {
        if (!$this->fields) {
            return '[]';
        }
        $results = '['.PHP_EOL;

        foreach ($this->fields as $column => $field) {
            if (isset($field['rule'])) {
                $results .= "\t\t\t'{$field['name']}' => '{$field['rule']}',".PHP_EOL;
            }
        }

        return $results."\t\t".']';
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $type = $this->type;
        $formRequest = $type == 'api' ? 'Dingo\Api\Http\FormRequest' : 'Illuminate\Foundation\Http\FormRequest';

        return array_merge(
            parent::getReplacements(),
            [
                'form_request' => $formRequest,
                'request_rules' => $this->getRules(),
            ]
        );
    }
}
