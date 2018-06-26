<?php
/**
 * Created by Sheldon
 * User: sheldon
 * Date: 18-04-02
 * Time: 下午4:55
 *
 * PHP version 7.1
 *
 * @category Yeelight
 *
 * @package Yeelight\Composers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */

namespace Yeelight\Composers;

use Illuminate\View\View;
use Yeelight\Models\AdminMenu;

/**
 * Class BackendMenuComposer
 *
 * @category Yeelight
 *
 * @package Yeelight\Composers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class BackendMenuComposer
{
    /**
     * Compose
     *
     * @param View $view view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        $view->with('backendMenus', (new AdminMenu())->toTree());
    }
}
