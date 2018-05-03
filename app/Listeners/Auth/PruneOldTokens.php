<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-5-3
 * Time: 下午6:18
 */
namespace Yeelight\Listeners\Auth;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Events\RefreshTokenCreated;

class PruneOldTokens
{
    use SerializesModels;


    /**
     * Handle the event.
     *
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', '!=', $event->accessTokenId)
            ->where('revoked', true)->delete();
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