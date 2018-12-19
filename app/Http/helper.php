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


/************** Validation Functions ***************/
if(!function_exists('validImg'))
{
    function validImg($type = null)
    {
        $valid = 'image:mimes:';
        return $type === null ? $valid . 'jpeg,bmp,gif,png': $valid . $type;
    }
}
