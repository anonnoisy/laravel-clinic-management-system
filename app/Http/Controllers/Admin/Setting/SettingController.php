<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource for system setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSystemSetting()
    {
        return view('admin.setting.system.edit');
    }

    /** 
     * Show the form for editing the specified resource sms setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSmsSetting()
    {
        return view('admin.setting.sms.edit');
    }

    /**
     * Update the specified resource in storage for system setting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSystemSetting(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage for sms setting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSmsSetting(Request $request)
    {
        //
    }
}
