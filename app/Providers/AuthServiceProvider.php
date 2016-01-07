<?php

namespace App\Providers;

use App\Connection;
use App\Policies\ConnectionPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\SkillPolicy;
use App\Policies\UserPolicy;
use App\Setting;
use App\Skill;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Skill::class => SkillPolicy::class,
        Connection::class => ConnectionPolicy::class,
        Setting::class => SettingsPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
