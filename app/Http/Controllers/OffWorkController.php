<?php

namespace App\Http\Controllers;

use App\DataTables\OffWorkDataTable;
use App\Http\Requests\OffWorkRequest;
use App\Models\OffWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OffWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OffWorkDataTable $offWorkDataTable)
    {
        //
        return $offWorkDataTable->render('off-work.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('off-work.create',[
            'employes' => \App\Models\Employee::where('off_work_total', '!=', 0)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OffWorkRequest $request)
    {
        ////
        // $dates = explode(' - ', $request->date_range);
        // $request['date_start'] = Carbon::parse($dates[0]);
        // $request['date_end'] = Carbon::parse($dates[1]);
        if($request->accepted_at)
        $request['accepted_at'] = now();


        OffWork::create($request->all());

        Session::flash('status', 'Off work has created');

        return redirect()->route('off-works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OffWork  $offWork
     * @return \Illuminate\Http\Response
     */
    public function show(OffWork $offWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OffWork  $offWork
     * @return \Illuminate\Http\Response
     */
    public function edit(OffWork $offWork)
    {
        //
        return view('off-work.edit', [
            'offWork' => $offWork,
            'employes' => \App\Models\Employee::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OffWork  $offWork
     * @return \Illuminate\Http\Response
     */
    public function update(OffWorkRequest $request, OffWork $offWork)
    {
        ////
        // $dates = explode(' - ', $request->date_range);
        // $request['date_start'] = Carbon::parse($dates[0]);
        // $request['date_end'] = Carbon::parse($dates[1]);
        // $request['accepted_at'] = $request->accepted_at ? now() : NULL; 
        if($request->accepted_at)
            $request['accepted_at'] = now();
        else{
            $request['accepted_at'] = NULL;
            $request['accepted_by'] = NULL;
        }

        $offWork->updateOrFail($request->all());

        Session::flash('status', 'off work has updated');

        return redirect()->route('off-works.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OffWork  $offWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(OffWork $offWork)
    {
        //
        $offWork->delete();

        Session::flash('status', 'off work has deleted');

        return redirect()->route('off-works.index');
    }

    
    /**
     * Accept the specified resource from storage.
     *
     * @param  \App\Models\OffWork  $offWork
     * @return \Illuminate\Http\Response
     */
    public function accept(OffWork $offWork)
    {
        //
        if(auth()->user()->role_id == \App\Models\Role::KARYAWAN)
        {
            Session::flash('status', 'Failed You don\'t have persmission');
            return redirect()->route('off-works.index');
        }

        $offWork->updateOrFail([
            'accepted_at' => now(),
            'accepted_by' => auth()->user()->id,
        ]);

        Session::flash('status', 'off work has accepted');

        return redirect()->route('off-works.index');
    }
}
