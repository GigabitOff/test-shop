<?php

namespace App\Http\Middleware;

use App\Models\Action;
use App\Models\ActionVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ActionVisitCounter
{
    protected string $cookieKey = 'visitActionUserKey';
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($identifier = $request->route('action')) {
            $action = Action::query()
                ->where('id', (int)$identifier)
                ->orWhere('slug', $identifier)
                ->first();

            if ($action){
                $query = ActionVisit:: query()
                    ->where('action_id', $action->id)
                    ->where(function($q){
                        $user_id = auth()->check() ? auth()->user()->id : 0;
                        $user_key = Cookie::get($this->cookieKey, '--');
                        $q->where('user_id', $user_id)
                            ->orWhere('unregister_user_key', $user_key);
                    });

                $self_host = request()->getHost();
                // на локальном сервере referrer пустой
                $referrer = parse_url($request->headers->get('referer'));
                if (!empty($referrer['host']) && $referrer['host'] === $self_host){
                    $query->where('referer', 'LIKE', "%{$self_host}%");
                } else {
                    $query->where('referer', ($request->headers->get('referer') ?? '--'));
                }

                if ($visit = $query->first()){
                    $visit->quantity += 1;
                    $visit->ip = $request->ip();
                } else {
                    $visit = new ActionVisit();
                    $visit->action()->associate($action);
                    $visit->ip = $request->ip();
                    $visit->referer = $request->headers->get('referer');

                    if (auth()->check()) {
                        $visit->user()->associate(auth()->user());
                    } else {
                        $user_key = bcrypt(time());
                        Cookie::queue(Cookie::forever($this->cookieKey, $user_key));
                        $visit->unregister_user_key = $user_key;
                    }
                }
                $visit->save();
            }
        };
        return $next($request);
    }
}
