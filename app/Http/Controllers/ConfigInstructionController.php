<?php

namespace App\Http\Controllers;

use App\ConfigInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigInstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['instructionTypes']= ConfigInstruction::instructionTypes();
        $data['configId'] = $configId = $request->configId;
        $data['configInstructions'] = ConfigInstruction::where('test_config_id', $configId)->orderBy('sequence','ASC')->latest()->paginate(20);
        return view('configInstruction.listData', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['configId'] = $request->configId;
        return view('configInstruction.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'      => 'required',
        ]);

        if ($request->hasFile('image')) {
            $sequence= ConfigInstruction::typeSerial();
            $file = $request->file('image');
            $file_name = time().'.'.$file->extension();
            $destinationPath = public_path('uploads/instruction/');
            $file->move($destinationPath, $file_name);

            $insert             = new ConfigInstruction();
            $insert->test_config_id       = $request->configId;
            $insert->instruction_type       =$request->instruction_type;
            $insert->sequence       = $sequence[$request->instruction_type];
            $insert->text       = $request->text;
            $insert->image      = $file_name;
            $insert->created_by = Auth::id(); // 1=Active
            $insert->save();

            $output['messege'] = 'Assessment Insruction has been created';
            $output['msgType'] = 'success';
        }else {
            $output['messege'] = 'Image Required';
            $output['msgType'] = 'danger';
        }

        return redirect()->back()->with($output);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data['configInstruction'] = ConfigInstruction::find($id);
        // return view('configInstruction.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ConfigInstruction::find($id)->delete();
        return ('success');
    }
}
