<?php

namespace Yeelight\Generators;

use Illuminate\Support\Str;
use League\Flysystem\FileNotFoundException;

/**
 * Class ViewsGenerator
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
class ViewsGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = '';

    /**
     * Get the views array.
     *
     * @var array
     */
    protected $views = [
        'index'  => 'index.blade.php',
        'create' => 'create.blade.php',
        'edit'   => 'edit.blade.php',
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
        return $this->getBasePath() .
            '/' .
            parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) .
            '/' .
            $this->getName() .
            '/';
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
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return resource_path('views');
    }

    /**
     * BuildCreateFormFields
     *
     * @return string
     */
    private function buildCreateFormFields()
    {
        $fields = $this->fields;
        $result = '';
        if (!empty($fields)) {
            foreach ($fields as $index => $field) {
                $result .= <<<EOF
                \n\t\t\t\t<div class="fields-group">
                    {{--Fields {$field['name']} Start--}}

                    <div class="form-group {!! !\$errors->has('{$field['name']}') ? '' : 'has-error' !!}">
                        <label for="{$field['name']}" class="col-sm-2 control-label">{{ \$columns['{$field['name']}'] }}</label>
                        <div class="col-sm-8">
                            @if(\$errors->has('{$field['name']}'))
                                @foreach(\$errors->get('{$field['name']}') as \$message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{\$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="{$field['name']}" name="{$field['name']}" value="" class="form-control {$field['name']}" placeholder="{{ trans('backend.input') }} {{ \$columns['{$field['name']}'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields {$field['name']} End--}}
                </div>\n
EOF;
            }
        }
        $result .= '';

        return $result;
    }

    /**
     * BuildEditFormFields
     *
     * @return string
     */
    private function buildEditFormFields()
    {
        $fields = $this->fields;
        $result = '';
        if (!empty($fields)) {
            foreach ($fields as $index => $field) {
                $result .= <<<EOF
                \n\t\t\t\t<div class="fields-group">
                    {{--Fields {$field['name']} Start--}}

                    <div class="form-group {!! !\$errors->has('{$field['name']}') ? '' : 'has-error' !!}">
                        <label for="{$field['name']}" class="col-sm-2 control-label">{{ \$columns['{$field['name']}'] }}</label>
                        <div class="col-sm-8">
                            @if(\$errors->has('{$field['name']}'))
                                @foreach(\$errors->get('{$field['name']}') as \$message)
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{\$message}}</label><br/>
                                @endforeach
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <input type="text" id="{$field['name']}" name="{$field['name']}" value="{{ \$data['{$field['name']}'] }}" class="form-control {$field['name']}" placeholder="{{ trans('backend.input') }} {{ \$columns['{$field['name']}'] }}">
                            </div>
                        </div>
                    </div>
                    {{--Fields {$field['name']} End--}}
                </div>\n
EOF;
            }
        }
        $result .= '';

        return $result;
    }

    /**
     * BuildIndexFilterFields
     *
     * @return string
     */
    private function buildIndexFilterFields()
    {
        $fields = $this->fields;
        $result = '';
        if (!empty($fields)) {
            foreach ($fields as $index => $field) {
                $result .= <<<EOF
                \n\t\t\t\t\t\t\t\t\t\t\t<div class="form-group">
                    \t\t\t\t\t\t\t<div class="form-group">
                        \t\t\t\t\t\t\t<label>{{ \$columns['{$field['name']}'] }}</label>
                        \t\t\t\t\t\t\t<div class="input-group">
                            \t\t\t\t\t\t\t<div class="input-group-addon">
                                \t\t\t\t\t\t\t<i class="fa fa-pencil"></i>
                            \t\t\t\t\t\t\t</div>
                            \t\t\t\t\t\t\t<input type="text" class="form-control {$field['name']}" placeholder="{{ \$columns['{$field['name']}'] }}" name="{$field['name']}" value="{{ isset(\$query['{$field['name']}']) ? \$query['{$field['name']}'] : ''}}">
                        \t\t\t\t\t\t\t</div>
                    \t\t\t\t\t\t\t</div>
                \t\t\t\t\t\t\t</div>\n
EOF;
            }
        }
        $result .= '';

        return $result;
    }

    /**
     * BuildIndexTableThFields
     *
     * @return string
     */
    private function buildIndexTableThFields()
    {
        $fields = $this->fields;
        $result = '';
        $_id_name = $this->getIdName();

        if (!empty($fields)) {
            $result .= <<<EOF
<th>{{ \$columns['{$_id_name}'] }}{!! column_sorter('{$_id_name}') !!}</th>\n
EOF;
            foreach ($fields as $index => $field) {
                $result .= <<<EOF
                        <th>{{ \$columns['{$field['name']}'] }}</th>\n
EOF;
            }
        }
        $result .= '';

        return $result;
    }

    /**
     * BuildIndexTableTdFields
     *
     * @return string
     */
    private function buildIndexTableTdFields()
    {
        $fields = $this->fields;
        $result = '';
        $_id_name = $this->getIdName();

        if (!empty($fields)) {
            $result .= <<<EOF
<td>
                                <input type="checkbox" class="grid-row-checkbox" data-id="{{ \$row['{$_id_name}'] }}" />
                            </td>
                            <td>{{ \$row['{$_id_name}'] }}</td>\n
EOF;
            foreach ($fields as $index => $field) {
                $result .= <<<EOF
                            <td>{{ \$row['{$field['name']}'] }}</td>\n
EOF;
            }
        }
        $result .= '';

        return $result;
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
                'model' => $this->getName(),
                'create_form_fields' => $this->buildCreateFormFields(),
                'edit_form_fields' => $this->buildEditFormFields(),
                'index_filter_fields' => $this->buildIndexFilterFields(),
                'index_table_th_fields' => $this->buildIndexTableThFields(),
                'index_table_td_fields' => $this->buildIndexTableTdFields(),
                '_id_name' => $this->getIdName(),
            ]
        );
    }

    /**
     * Run the generator.
     *
     * @return int|void
     * @throws FileAlreadyExistsException
     * @throws FileNotFoundException
     */
    public function run()
    {
        foreach ($this->views as $index => $view) {
            if ($this->filesystem->exists($path = $this->getPath().$view) && !$this->force) {
                throw new FileAlreadyExistsException($path);
            }

            if (!$this->filesystem->isDirectory($dir = dirname($path))) {
                $this->filesystem->makeDirectory($dir, 0777, true, true);
            }

            $stubsOverridePath = config('repository.generator.stubsOverridePath', __DIR__);

            if (!file_exists($stubsOverridePath."/Stubs/views/{$index}.stub")) {
                $stubsOverridePath = __DIR__;
            }

            if (!file_exists($stubsOverridePath."/Stubs/views/{$index}.stub")) {
                throw new FileNotFoundException($stubsOverridePath."/Stubs/views/{$index}.stub");
            }

            $this->stub = 'views/'.$index;

            $this->filesystem->put($path, $this->getStub());
        }
    }
}
