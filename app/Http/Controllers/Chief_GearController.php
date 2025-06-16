<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Chief_Gear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Chief_GearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $chief_gear = Chief_Gear::where('Tier', 'LIKE', "%$keyword%")
                ->orWhere('Stars', 'LIKE', "%$keyword%")
                ->orWhere('Hardened_Alloy', 'LIKE', "%$keyword%")
                ->orWhere('Polishing_Solution', 'LIKE', "%$keyword%")
                ->orWhere('Design_Plans', 'LIKE', "%$keyword%")
                ->orWhere('Lunar_Amber', 'LIKE', "%$keyword%")
                ->orWhere('Power', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $chief_gear = Chief_Gear::latest()->paginate($perPage);
        }

        return view('chief_-gear.index', compact('chief_gear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('chief_-gear.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Chief_Gear::create($requestData);

        return redirect('chief_-gear')->with('flash_message', 'Chief_Gear added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $chief_gear = Chief_Gear::findOrFail($id);

        return view('chief_-gear.show', compact('chief_gear'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $chief_gear = Chief_Gear::findOrFail($id);

        return view('chief_-gear.edit', compact('chief_gear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $chief_gear = Chief_Gear::findOrFail($id);
        $chief_gear->update($requestData);

        return redirect('chief_-gear')->with('flash_message', 'Chief_Gear updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Chief_Gear::destroy($id);

        return redirect('chief_-gear')->with('flash_message', 'Chief_Gear deleted!');
    }

    public function calculate_chief_gear()
    {
        $tiersWithStars = DB::table('chief__gears')->get();

        return view('chief_-gear.gear_calculator', compact('tiersWithStars'));
    }

}
