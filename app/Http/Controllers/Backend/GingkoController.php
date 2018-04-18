<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yeelight\Http\Controllers\Controller;

use Yeelight\Models\GingkoFirmware;

/**
 * Gingko 床头灯 固件管理
 */
class GingkoController extends BaseController
{

    public function __construct()
    {
        
    }

    /**
     * Gingko firmware list
     */
    public function index()
    {
        $columns = trans( 'firmware.columns' );
        $lists = GingkoFirmware::paginate(null, ['*']);

        return view( 'backend.firmware_gingko.index', compact( 'columns', 'lists' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'backend.firmware_gingko.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view( 'backend.firmware_gingko.show' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view( 'backend.firmware_gingko.edit' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
