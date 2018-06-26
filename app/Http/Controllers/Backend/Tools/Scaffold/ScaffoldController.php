<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-25
 * Time: 下午3:25.
 */

namespace Yeelight\Http\Controllers\Backend\Tools\Scaffold;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Yeelight\Http\Controllers\BaseController;

/**
 * Class ScaffoldController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend\Tools\Scaffold
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ScaffoldController extends BaseController
{
    /**
     * 主页.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dbTypes = [
            'string',
            'integer',
            'text',
            'float',
            'double',
            'decimal',
            'boolean',
            'date',
            'time',
            'dateTime',
            'timestamp',
            'char',
            'mediumText',
            'longText',
            'tinyInteger',
            'smallInteger',
            'mediumInteger',
            'bigInteger',
            'unsignedTinyInteger',
            'unsignedSmallInteger',
            'unsignedMediumInteger',
            'unsignedInteger',
            'unsignedBigInteger',
            'enum',
            'json',
            'jsonb',
            'dateTimeTz',
            'timeTz',
            'timestampTz',
            'nullableTimestamps',
            'binary',
            'ipAddress',
            'macAddress',
        ];
        $action = URL::current();

        return view('backend.tools.scaffold.index', [
            'header_description' => '脚手架',
            'dbTypes'            => $dbTypes,
            'action'             => $action,
        ]);
    }

    public function store(Request $request)
    {
        $paths = [];
        $message = '';

        try {
            $model_name = Str::camel(
                ucfirst(str_singular(lcfirst(ucwords($request->get('model_name')))))
            );

            $force = false;
            if (in_array('force', $request->get('create'))) {
                $force = true;
            }

            $presenter = $validator = 'no';
            $fillable = $rules = '';
            $fields = $request->get('fields');

            if (!empty($fields)) {
                foreach ($fields as $index => $field) {
                    if ($field['name'] && $field['type']) {
                        $fillable .= $field['name'].':'.$field['type'];
                        if (isset($field['nullable'])) {
                            $fillable .= ':nullable()';
                        }
                        if ($field['key']) {
                            $fillable .= ':'.$field['key'];
                        }
                        if ($field['default']) {
                            $fillable .= ':default'."('{$field['default']}')";
                        }
                        if ($field['comment']) {
                            $fillable .= ':comment'."('{$field['comment']}')";
                        }
                        $fillable .= ',';
                        if ($field['rule']) {
                            $rules .= $field['name'].'=>'.$field['rule'].',';
                        }
                    }
                }
            }

            $fillable = rtrim($fillable, ',');

            $rules = rtrim($rules, ',');

            // 1. Create presenter.
            if (in_array('presenter', $request->get('create'))) {
                Artisan::call('yl:presenter', [
                    'name'    => $model_name,
                    '--force' => $force,
                ]);
                $paths['presenters'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('presenters', true).'/'.$this->getName($model_name).'Presenter.php';

                Artisan::call('yl:transformer', [
                    'name'     => $model_name,
                    '--fields' => $fields,
                    '--force'  => $force,
                ]);
                $paths['transformers'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('transformers', true).'/'.$this->getName($model_name).'Transformer.php';

                $presenter = 'yes';
            }

            // 2. Create validator.
            if (in_array('validator', $request->get('create'))) {
                Artisan::call('yl:validator', [
                    'name'    => $model_name,
                    '--rules' => $rules,
                    '--force' => $force,
                ]);
                $paths['validators'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('validators', true).'/'.$this->getName($model_name).'Validator.php';
                $validator = 'yes';
            }

            // 3. Create controller.
            if (in_array('controller', $request->get('create'))) {
                Artisan::call('yl:controller', [
                    'name'     => $model_name,
                    '--fields' => $fields,
                    '--force'  => $force,
                ]);
                $paths['controllers'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('controllers', true).'/'.Str::plural($this->getName($model_name)).'Controller.php';
                $paths['create_request'] = $this->getBasePath().'/Http/Requests/'.$this->getName($model_name).'CreateRequest.php';
                $paths['update_request'] = $this->getBasePath().'/Http/Requests/'.$this->getName($model_name).'UpdateRequest.php';
            }

            // 4. Create views.
            if (in_array('views', $request->get('create'))) {
                Artisan::call('yl:views', [
                    'name'     => $model_name,
                    '--fields' => $fields,
                    '--force'  => $force,
                ]);
                $paths['views_index'] = resource_path($this->getConfigGeneratorClassPath('views', true)).'/'.$this->getSnakeName($model_name).'/index.blade.php';
                $paths['views_create'] = resource_path($this->getConfigGeneratorClassPath('views', true)).'/'.$this->getSnakeName($model_name).'/create.blade.php';
                $paths['views_edit'] = resource_path($this->getConfigGeneratorClassPath('views', true)).'/'.$this->getSnakeName($model_name).'/edit.blade.php';
            }

            // 5. Create language package.
            if (in_array('lang', $request->get('create'))) {
                Artisan::call('yl:lang', [
                    'name'     => $model_name,
                    '--fields' => $fields,
                    '--force'  => $force,
                ]);
                $filesystem = new Filesystem();
                $directories = $filesystem->directories(resource_path($this->getConfigGeneratorClassPath('lang', true)));
                foreach ($directories as $index => $directory) {
                    $paths['lang_'.$index] = $directory.'/'.$this->getSnakeName($model_name).'.php';
                }
            }

            // 6. Create api controller.
            if (in_array('api_controller', $request->get('create'))) {
                Artisan::call('yl:api_controller', [
                    'name'     => $model_name,
                    '--fields' => $fields,
                    '--force'  => $force,
                ]);
                $paths['api_controllers'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('api_controllers', true).'/'.Str::plural($this->getName($model_name)).'Controller.php';
                $paths['api_create_request'] = $this->getBasePath().'/Http/Requests/Api/'.$this->getName($model_name).'CreateRequest.php';
                $paths['api_update_request'] = $this->getBasePath().'/Http/Requests/Api/'.$this->getName($model_name).'UpdateRequest.php';
            }

            //7. Create repository
            Artisan::call('yl:repository', [
                'name'        => $model_name,
                '--fillable'  => $fillable,
                '--rules'     => $rules,
                '--fields'    => $fields,
                '--validator' => $validator,
                '--presenter' => $presenter,
                '--force'     => $force,
            ]);
            $paths['repositories'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('repositories', true).'/'.$this->getName($model_name).'RepositoryEloquent.php';
            $paths['interfaces'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('interfaces', true).'/'.$this->getName($model_name).'Repository.php';
            $paths['models'] = $this->getBasePath().'/'.$this->getConfigGeneratorClassPath('models', true).'/'.($model_name).'.php';

            //8. Bind repository
            Artisan::call('yl:bindings', [
                'name'    => $model_name,
                '--force' => $force,
            ]);

            // 9. Run migrate.
            if (in_array('migrate', $request->get('create'))) {
                Artisan::call('migrate');
                $message = Artisan::output();
            }
        } catch (\Exception $exception) {
            // Delete generated files if exception thrown.
            app('files')->delete($paths);

            return $this->backWithException($exception);
        }

        return $this->backWithSuccess($model_name, $paths, $message);
    }

    protected function backWithException(\Exception $exception)
    {
        $error = new MessageBag([
            'title'   => 'Error',
            'message' => $exception->getMessage()."\n Please delete the migration files",
        ]);

        return back()->withInput()->with(compact('error'));
    }

    protected function backWithSuccess($model_name, $paths, $message)
    {
        $messages = [];
        foreach ($paths as $name => $path) {
            $messages[] = ucfirst($name).": $path";
        }
        $messages[] = 'Migrations: '.database_path('migrations').'/'.date('Y_m_d').'_xxxxxx_create_'.$this->getSnakeName($model_name).'.php';
        $messages[] = "<br />$message";
        $success = new MessageBag([
            'title'   => 'Success',
            'message' => implode('<br />', $messages),
        ]);

        return back()->with(compact('success'));
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
     * Get name input.
     *
     * @param $name
     *
     * @return string
     */
    public function getName($name)
    {
        if (str_contains($name, '\\')) {
            $name = str_replace('\\', '/', $name);
        }
        if (str_contains($name, '/')) {
            $name = str_replace('/', '/', $name);
        }

        return Str::studly(str_replace(' ', '/', ucwords(str_replace('/', ' ', $name))));
    }

    /**
     * Get name input.
     *
     * @param $name
     *
     * @return string
     */
    public function getSnakeName($name)
    {
        if (str_contains($name, '\\')) {
            $name = str_replace('\\', '/', $name);
        }
        if (str_contains($name, '/')) {
            $name = str_replace('/', '/', $name);
        }

        return Str::plural(Str::snake(str_replace(' ', '/', ucwords(str_replace('/', ' ', $name)))));
    }

    /**
     * Get class-specific output paths.
     *
     * @param $class
     *
     * @return string
     */
    private function getConfigGeneratorClassPath($class, $directoryPath = false)
    {
        switch ($class) {
            case 'models' === $class:
                $path = config('repository.generator.paths.models', 'Entities');
                break;
            case 'repositories' === $class:
                $path = config('repository.generator.paths.repositories', 'Repositories');
                break;
            case 'interfaces' === $class:
                $path = config('repository.generator.paths.interfaces', 'Repositories');
                break;
            case 'presenters' === $class:
                $path = config('repository.generator.paths.presenters', 'Presenters');
                break;
            case 'transformers' === $class:
                $path = config('repository.generator.paths.transformers', 'Transformers');
                break;
            case 'validators' === $class:
                $path = config('repository.generator.paths.validators', 'Validators');
                break;
            case 'controllers' === $class:
                $path = config('repository.generator.paths.controllers', 'Http\Controllers');
                break;
            case 'api_controllers' === $class:
                $path = config('repository.generator.paths.api_controllers', 'Http/Controllers/Api/Controllers');
                break;
            case 'provider' === $class:
                $path = config('repository.generator.paths.provider', 'RepositoryServiceProvider');
                break;
            case 'criteria' === $class:
                $path = config('repository.generator.paths.criteria', 'Criteria');
                break;
            case 'views' === $class:
                $path = config('repository.generator.paths.views', 'views');
                break;
            case 'lang' === $class:
                $path = config('repository.generator.paths.criteria', 'lang');
                break;
            default:
                $path = '';
        }

        if ($directoryPath) {
            $path = str_replace('\\', '/', $path);
        } else {
            $path = str_replace('/', '\\', $path);
        }

        return $path;
    }
}
