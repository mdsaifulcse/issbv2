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
                $testLists=TestList::join('test_config','test_lists.id','test_config.test_for')->where('test_lists.status',1)->latest('test_lists.id')->get();
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
