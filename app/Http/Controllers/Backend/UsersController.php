<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\UserCreateRequest;
use Yeelight\Http\Requests\UserUpdateRequest;
use Yeelight\Models\Basic\CountryModel;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\UserValidator;

/**
 * Class UsersController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class UsersController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    public function __construct(
        UserRepository $repository,
        UserValidator $validator
        ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = trans('users.columns');
        $countries = CountryModel::getCountryList();
        $timezones = timezone_identifiers_list();
        $locales = CountryModel::getLocaleCallingCodes();

        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.users.index', [
            'lists'     => $lists,
            'columns'   => $columns,
            'countries' => $countries,
            'timezones' => $timezones,
            'locales'   => $locales,
            'paginator' => $paginator,
            'query'     => request()->query(),
        ]);
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $columns = trans('users.columns');
        $countries = CountryModel::getCountryList();
        $timezones = timezone_identifiers_list();
        $locales = CountryModel::getLocaleCallingCodes();

        return view('backend.users.create', [
            'columns'   => $columns,
            'countries' => $countries,
            'timezones' => $timezones,
            'locales'   => $locales,
        ]);
    }

    /**
     * Edit.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->repository->find($id);
        $columns = trans('users.columns');
        $countries = CountryModel::getCountryList();
        $timezones = timezone_identifiers_list();
        $locales = CountryModel::getLocaleCallingCodes();

        return view('backend.users.edit', [
            'data'      => $data['data'],
            'columns'   => $columns,
            'countries' => $countries,
            'timezones' => $timezones,
            'locales'   => $locales,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $result = $this->repository->create($data);

        if ($result) {
            return $this->redirectAfterStore();
        } else {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.save_failed'),
            ]);

            return redirect(route('users.create'))->with(compact('error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();

        $result = $this->repository->update($data, $id);

        if ($result) {
            return $this->redirectAfterUpdate();
        } else {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.update_failed'),
            ]);

            return redirect($request->session()->previousUrl())->with(compact('error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);
        $deleted = $this->repository->deleteIn($ids);

        if ($deleted) {
            return response()->json([
                'status'  => true,
                'message' => trans('backend.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('backend.delete_failed'),
            ]);
        }
    }
}
