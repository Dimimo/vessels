<?php

namespace App\Http\Controllers;

use App\Vessel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vessels = Vessel::with(['operator'])->orderBy('name')->get();

        return view('vessel.index', compact('vessels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Vessel $vessel
     * @return Response
     */
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vessel $vessel
     * @return Response
     */
    public function edit(Vessel $vessel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vessel  $vessel
     * @return Response
     */
    public function update(Request $request, Vessel $vessel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vessel $vessel
     * @return Response
     */
    public function destroy(Vessel $vessel)
    {
        //
    }
}
