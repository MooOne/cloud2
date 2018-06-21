<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-2
 * Time: 上午10:06.
 */

namespace Yeelight\Services\Assets;

class Assets
{
    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * Add css or get all css.
     *
     * @param null $css
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public static function css($css = null)
    {
        if (!is_null($css)) {
            self::$css = array_merge(self::$css, (array) $css);

            return;
        }

        return view('backend.partials.css', ['css' => array_unique(static::$css)]);
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public static function js($js = null)
    {
        if (!is_null($js)) {
            self::$js = array_merge(self::$js, (array) $js);

            return;
        }

        return view('backend.partials.js', ['js' => array_unique(static::$js)]);
    }

    /**
     * @param string $script
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public static function script($script = '')
    {
        if (!empty($script)) {
            self::$script = array_merge(self::$script, (array) $script);

            return;
        }

        return view('backend.partials.script', ['script' => array_unique(self::$script)]);
    }
}
