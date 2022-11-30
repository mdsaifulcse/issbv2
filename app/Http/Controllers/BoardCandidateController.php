<?php

namespace App\Http\Controllers;

use Auth;
use App\BoardCandidate;
use Illuminate\Http\Request;

class BoardCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['boardCandidates'] = BoardCandidate::latest('id')->paginate(100);
        return view('testingOfficer.boardCandidate.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testingOfficer.boardCandidate.create');
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
            'board_name'      => 'required',
            'total_candidate' => 'required',
            'status'          => 'required',
        ]);
        $activeBoard = BoardCandidate::where('status', 1)->first();
        if (!empty($activeBoard) && $request->status == 1) {
            $activeBoard->update(['status' => 0]);
        }
        BoardCandidate::create([
            'board_name'      => $request->board_name,
            'total_candidate' => $request->total_candidate,
            'status'          => $request->status,
        ]);

        $output['messege'] = 'Board Candidate has been Created';
        $output['msgType'] = 'success';
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
        $data['boardCandidate'] = BoardCandidate::find($id);
        return view('testingOfficer.boardCandidate.update', $data);
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
        $this->validate($request, [
            'board_name'      => 'required',
            'total_candidate' => 'required',
            'status'          => 'required',
        ]);
        $activeBoard = BoardCandidate::where('status', 1)->where('id', '!=', $id)->first();
        if (!empty($activeBoard) && $request->status == 1) {
            $activeBoard->update(['status' => 0]);
        }
        BoardCandidate::find($id)->update([
            'board_name'      => $request->board_name,
            'total_candidate' => $request->total_candidate,
            'status'          => $request->status,
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        $output['messege'] = 'Board Candidate has been updated';
        $output['msgType'] = 'success';
        return redirect()->back()->with($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BoardCandidate::find($id)->update([
            'status'     => 0, //0=Inactive
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Auth::id(),
        ]);
        return ('success');
    }


    //GET CANDIDATE BOARD
    public function getCandidateBoard(Request $request){
        $activeBoard = BoardCandidate::where('status', 1)->first();

        $output['board_name']       = $activeBoard->board_name;
        $output['total_candidate']  = $activeBoard->total_candidate;

        return $output;
    }
}
