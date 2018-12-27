<?php

if(!function_exists('aurl'))
{
    function aurl($url=null)
    {
        return '/admin/' . $url;
    }
}

if(!function_exists('admin'))
{
    /**
     * @param string $guard
     * @return \Illuminate\Auth\SessionGuard
     */
    function admin($guard='admin')
    {
        return auth()->guard($guard);
    }
}

if(!function_exists('lang'))
{
    /**
     * @return mixed|string
     */
    function lang()
    {
        return session()->has('lang') && in_array(session('lang'), config('app.locales')) ?
                    session('lang') :
                        settings()->lang;

    }
}

if(!function_exists('direction'))
{
    /**
     * @return string rtl|ltr
     */
    function direction()
    {
        return app()->getLocale() == 'ar' ? 'rtl' : 'ltr';
    }
}

if(!function_exists('activeMenu'))
{
    /**
     * @param int $index
     * @param null $seg
     * @param bool $link
     * @return string
     */
    function activeMenu($index = 1, $seg = null, $link = false)
    {
        $class = $link === false ? 'active' : 'active menu-open';
        return request()->segment($index) == $seg ? $class : '';
    }
}

if(!function_exists('settings'))
{
    /**
     * @return \App\Model\Setting
     */
    function settings()
    {
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
}

if(!function_exists('up'))
{
    /**
     * @return \App\Helper\Uploader
     */
    function up()
    {
        return app()->make('uploader');
    }
}

if(!function_exists('imgSrc'))
{
    /**
     * @param $src
     * @return string image src
     */
    function imgSrc($src)
    {
        return \Storage::url($src);
    }
}

if(!function_exists('departsJson'))
{
    /**
     *  { "id" : "1", "parent" : "#", "text" : "Simple root node" },
        { "id" : "2", "parent" : "#", "text" : "Root node 2", "state": {opened: true, selected: true} },
        { "id" : "3", "parent" : "2", "text" : "Child 1" },
        { "id" : "4", "parent" : "2", "text" : "Child 2" },
     */
    /**
     * @param null $selected
     * @return string
     */
    function departsJson($selected = null, $hide = null)
    {
        $departments = \App\Model\Department::select('id')
            ->addSelect('parent_id as parent')
            ->addSelect('name_' . (lang()) . ' as name')
            ->get();

        $departs_arr = [];
        foreach($departments as $department)
        {
            $depart = [];
            $depart['id'] = $department->id;
            $depart['text'] = $department->name;
            $depart['parent'] = $department->parent ?: '#';
            $selected && $selected == $department->id ?
                $depart['state'] = ['opened' => true, 'selected' => true] :
                NULL;
            // 1
            $hide && ($hide == $department->id) ?
                $depart['state'] = ['disabled' => true, 'opened' => false, 'selected' => false] :
                NULL;

            $hide && ($hide == $department->parent) ?
                $depart['state'] = ['disabled' => true, 'opened' => false, 'selected' => false, 'hidden' => true] :
                NULL;

            array_push($departs_arr, $depart);
        }

        return json_encode($departs_arr, JSON_UNESCAPED_UNICODE);
    }
}


/************** Validation Functions ***************/
if(!function_exists('validImg'))
{
    function validImg($type = null)
    {
        $valid = 'image:mimes:';
        return $type === null ? $valid . 'jpeg,bmp,gif,png': $valid . $type;
    }
}
