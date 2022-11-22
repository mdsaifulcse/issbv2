<?php

namespace App\Providers;

use App\Candidates;
use App\TestConfiguration;
use App\TestList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'candidates.layouts.default',
            function ($view)
            {
                $authId = Auth::guard('candAuth')->id();
                $data['userInfo'] = Candidates::find($authId);
                $view->with(['data'=>$data]);
            }
        );
        view()->composer(
            'admin.layouts.default',
            function ($view)
            {
                $testLists=TestList::get();
                $view->with(['testLists'=>$testLists]);
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
