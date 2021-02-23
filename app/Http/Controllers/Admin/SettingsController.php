<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteSettings;

class SettingsController extends Controller
{
    /**
     * @param SiteSettings $setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SiteSettings $setting)
    {
        $settings = $setting->getAllData() ?? null;
        $types = $setting->getTypes();
        return view('admin.settings.index', [
            'pageTitle' => trans('admin.settings'),
            'settings'  => $settings,
            'types' => $types,
            ]);
    }

    /**
     * @param Request $request
     * @param SiteSettings $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, SiteSettings $setting)
    {
        $request->validate([
            'key' => 'required',
            'label' => 'required',
        ]);

        $setting->setData($request);
        return redirect()->route('settings')
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param SiteSettings $settings
     * @return array
     */
    public function updateItem($id, Request $request, SiteSettings $settings)
    {
        $settings->update($id, ['value' => $request->input('value')]);

        return redirect()->route('settings')
            ->with('success', trans('admin.changes_saved_successfully'));
    }

    /**
     * @param $key
     * @param SiteSettings $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($key, SiteSettings $setting)
    {
        if($setting->deleteSetting($key)){
            return redirect()
                ->route('settings')
                ->with('success', trans('admin.item_successfully_deleted'));
        }
        return redirect()
            ->route('settings')
            ->with('error', trans('admin.error_delete'));
    }
}
