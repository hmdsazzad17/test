<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caseStudies = CaseStudy::all();
        return view('case-studies.index', ['caseStudies' => $caseStudies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('case-studies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('case-studies', 'public');
        }

        CaseStudy::create($data);

        return redirect()->route('case-studies.index')->with('success', 'Case study created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseStudy $caseStudy)
    {
        return view('case-studies.edit', compact('caseStudy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CaseStudy $caseStudy)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('case-studies', 'public');
        }

        $caseStudy->update($data);

        return redirect()->route('case-studies.index')->with('success', 'Case study updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->delete();

        return redirect()->route('case-studies.index')->with('success', 'Case study deleted successfully.');
    }
}
