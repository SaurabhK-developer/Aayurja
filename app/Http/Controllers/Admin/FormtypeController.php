<?php

namespace App\Http\Controllers\Admin;

use App\Formtype;
use App\Author;
use Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::user()->role != 1 || Auth::user()->role == null)
        // {
        //     return abort(401);
        // }

        // if (! Gate::allows('subcategories_manage')) {
        //     return abort(401);
        // }

        $form_type = Formtype::get();

        return view('admin.formtype.index', compact('form_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.formtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'form_type_name' => 'required|array',
        ]);
    
        $uniqueFormTypeNames = array_unique($validatedData['form_type_name']); // Remove duplicates
    
        foreach ($uniqueFormTypeNames as $form_type_name) {
            FormType::firstOrCreate(['form_type_name' => $form_type_name]);
        }
    
        return redirect()->route('admin.formtype.index')->with('success', 'Form types added successfully!');
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
    $formType = FormType::findOrFail($id); 
    return view('admin.formtype.edit', compact('formType'));
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
    $validatedData = $request->validate([
        'form_type_name' => 'required|string|max:255', 
    ]);

    $formType = FormType::findOrFail($id); 

    $formType->update([
        'form_type_name' => $validatedData['form_type_name'],
    ]);

    return redirect()->route('admin.formtype.index')->with('success', 'Form type updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $formType = FormType::findOrFail($id); 
    $formType->delete(); 

    return redirect()->route('admin.formtype.index')->with('success', 'Form type deleted successfully!');
    }
}
