<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperator;
use App\Operator;
use Illuminate\Http\Response;

/**
 * Class OperatorController
 * @package App\Http\Controllers
 */
class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $operators = Operator::with(['city', 'admins', 'ports', 'vessels'])->orderBy('name')->get();

        return view('operator.index', compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('operator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOperator $request
     * @return Response
     */
    public function store(StoreOperator $request)
    {
        $operator = new Operator($request->validated());
        $operator->save();

        return redirect()->route('port.show', [$operator->id])->with(['success' => 'The Operator ' . $operator->name . ' has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @param string  $slug
     * @return Response
     */
    public function show($id, $slug = null)
    {
        $operator = Operator::with(['vessels' => function ($q) {
            return $q->orderBy('name');
        }, 'ports'                            => function ($q) {
            return $q->orderBy('name');
        }])->findOrFail($id);

        return view('operator.show', compact('operator', 'slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     * @param string  $slug
     * @return Response
     */
    public function edit($id, $slug = null)
    {
        $operator = Operator::findOrFail($id);

        return view('operator.update', compact('operator', 'slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOperator $request
     * @param Operator      $operator
     * @return Response
     */
    public function update(StoreOperator $request, Operator $operator)
    {
        $operator = $operator::findOrFail($request->get('id'));
        $operator->update($request->validated());

        return redirect()->route('operator.show', [$operator->id, $operator->slug])->with(['success' => $operator->name . ' has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return Response
     */
    public function destroy($id)
    {
        $operator = Operator::with(['vessels', 'captains'])->findOrFail($id);
        if ($operator->vessels->count() > 0) {
            return back()->with(['warning' => $operator->name . " can't be deleted, it still has vessels!"]);
        }
        if ($operator->captains->count() > 0) {
            return back()->with(['warning' => $operator->name . " can't be deleted, it still has captains!"]);
        }
        $operator->delete();

        return redirect()->route('operator.index')->with(['success' => $operator->name . " has been deleted!"]);
    }

    public function users()
    {
        //
    }
}
