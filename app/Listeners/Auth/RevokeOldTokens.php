<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-5-3
 * Time: 下午6:14.
 */

namespace Yeelight\Listeners\Auth;

use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;

/**
 * Class RevokeOldTokens
 *
 * @category Yeelight
 *
 * @package Yeelight\Listeners\Auth
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class RevokeOldTokens
{
    use SerializesModels;

    /**
     * Handle the event.
     *
     * @param AccessTokenCreated $event AccessTokenCreated
     *
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        Token::where('id', '!=', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            ->where('expires_at', '<', Carbon::now())
            ->orWhere('revoked', true)
            ->delete();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
