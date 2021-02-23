<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Unisharp\Setting\Setting;
use Illuminate\Http\Request;

class SiteSettings extends Setting
{
    /**
     * @return array
     */
    public function getTypes()
    {
        return [
            'text' => trans('admin.string'),
            'textarea' => trans('admin.text_area'),
            //'file' => trans('admin.images'),
            'checkbox' => trans('admin.checkbox'),
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllData()
    {
        return DB::table('settings')
            ->where('locale', app()->getLocale())
            ->orWhere('locale', 'all')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param Request $request
     */
    public function setData(Request $request)
    {
        DB::table('settings')->insert([
            'label' => $request->get('label'),
            'key' => $request->get('key'),
            'locale' => $request->get('locale'),
            'type' => $request->get('type'),
        ]);

    }

    /**
     * @param $id
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function find($id)
    {
        return DB::table('settings')->where('id', $id)->first();
    }

    /**
     * @param $id
     * @param $arrayData
     * @return int
     */
    public function update($id, $arrayData)
    {
        return DB::table('settings')
            ->where('id', $id)
            ->update($arrayData);
    }

    /**
     * @param $key
     * @param string $locale
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getSetting($key, $locale = 'all')
    {
        return DB::table('settings')
            ->where('key', $key)
            ->where('locale', $locale)
            ->first();
    }

    /**
     * @param $key
     * @return int
     */
    public function deleteSetting($key)
    {
        return DB::table('settings')->where('key', $key)->delete();
    }
}
