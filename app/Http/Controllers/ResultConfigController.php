<?php

namespace App\Http\Controllers;
use\App\TestList;
use App\TestConfiguration;
use App\ResultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator;

class ResultConfigController extends Controller
{
    public function index(){
        $test_list = TestList::get();
        return view('create_result_config', compact('test_list'));
    }

    public function createLoadRestResultConfig($textConfigId,$totalItems){
        $testConfig= TestConfiguration::with('testFor')->find($textConfigId);
        $totalItems+=1;
        return view('load_test_result_config',compact('totalItems','testConfig'));
    }


    public function saveResultConfig(Request $request){

        $existsResultConfig=ResultConfig::where(['test_id'=>$request->test_id,'test_config_id'=>$request->test_config_id])->first();

        if($existsResultConfig){
            return redirect()->back()->with('errors','Result config already exists');
        }


        $validator = Validator::make($request->all(), [
            
            'raw_score' => 'required|array',
            'raw_score.*' => 'numeric:min:0|max:999',
            'estimated_score' => 'required|array',
            'estimated_score.*' => 'numeric:min:0|max:999',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //return $request;
        
        DB::beginTransaction();
        try{
        foreach($request->raw_score as $key=>$raw_score){
            //return $request->estimated_score;

            $resultConfigInput[]=[
                'raw_score'=>$raw_score,
                'estimated_score'=>$request->estimated_score[$key],
                'test_id'=>$request->test_id,
                'test_config_id'=>$request->test_config_id,

            ];

        }

        ResultConfig::insert($resultConfigInput);
        DB::commit();
        return redirect('/test-configuration-list')->with('success','Result Config Successfully Save');
    }catch(Exception $e){
        DB::rollback();
        return redirect()->back()->with('error',$e->getMessage());
    }
    }



    public function editLoadRestResultConfig($textConfigId,$totalItems){

        $testConfig= TestConfiguration::with('testFor','resultConfigData')->find($textConfigId);
        $totalItems+=1;
        return view('load_edit_test_result_config',compact('totalItems','testConfig'));
    }
    public function updateResultConfig(Request $request){

        $oldResultConfigs= ResultConfig::where(['test_id'=>$request->test_id,'test_config_id'=>$request->test_config_id])->get();
        if(count($oldResultConfigs)>0){
            foreach($oldResultConfigs as $oldResultConfig){
                $oldResultConfig->delete();
            }
        }

    $validator = Validator::make($request->all(), [

        'raw_score' => 'required|array',
        'raw_score.*' => 'numeric:min:0|max:999',
        'estimated_score' => 'required|array',
        'estimated_score.*' => 'numeric:min:0|max:999',
    ]);
    if ($validator->fails())
    {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();
    try{
        foreach($request->raw_score as $key=>$raw_score){
            //return $request->estimated_score;

            $resultConfigInput[]=[
                'raw_score'=>$raw_score,
                'estimated_score'=>$request->estimated_score[$key],
                'test_id'=>$request->test_id,
                'test_config_id'=>$request->test_config_id,

            ];
        }

        ResultConfig::insert($resultConfigInput);
        DB::commit();
        return redirect('/test-configuration-list')->with('success','Result Config Successfully Update');
    }catch(Exception $e){
        DB::rollback();
        return redirect()->back()->with('error',$e->getMessage());
    }
}
}
