<?php

namespace App\Providers;

use App\Candidates;
use App\TestConfiguration;
use App\TestGroups;
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
                $test_groups = TestGroups::get();
                foreach ($test_groups as $key => $value) {
                    $explode_test_config_id[] = explode('||', $value->test_config_id);
                }

                // Generate group test list id
                if (isset($explode_test_config_id)) {
                    $merged_test_config_id = array_merge(...$explode_test_config_id);
                    $unique_test_config_id = array_unique($merged_test_config_id);
                } else {
                    $unique_test_config_id = [''];
                }

                $testLists=TestList::join('test_config','test_lists.id','test_config.test_for')
                    ->select('test_config.id as test_config_id','test_lists.*')
                    ->where('test_lists.status',1)->groupBy('test_lists.id')->latest('test_lists.id');

                // without group test list ids ------
                if (count($unique_test_config_id)>0){
                    $testLists=$testLists->whereNotIn('test_lists.id', $unique_test_config_id);
                }

                $testLists=$testLists->get();

                // -------------Test Group ------------------
                $testGroups = TestGroups::get();
                foreach ($testGroups as $i => $value) {
                    $testIds=explode('||', $value->test_config_id);

                    $testListsData=TestList::select('id','name')->whereIN('id', $testIds)->get();
                    $value['groupName']=TestGroups::GROUPNAMES[$value->groups];
                    $value['testLists']=$testListsData;

                    // Generate test name--------
                    $testName='';
                    foreach ($testListsData as $j=>$testList){
                        if($j==0){
                            $testName.=''.$testList->name;
                        }else{
                            $testName.='/'.$testList->name;
                        }

                    }
                    $value['testName']=$testName;

                }

                $view->with(['testLists'=>$testLists,'testGroups'=>$testGroups]);
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
