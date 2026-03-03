<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dynamicemail;
use App\Formtype;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\User;

class DynamicEmailController extends Controller
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

        $dynamicemails = DynamicEmail::with('Formtype')->get();

        return view('admin.dynamic-email.index', compact('dynamicemails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('subcategories_manage')) {
        //     return abort(401); 
        // }
    
        $formTypes = Formtype::get();
    
        $dynamicEmails = Dynamicemail::with('Formtype')->get(); 
    
        return view('admin.dynamic-email.create', compact('dynamicEmails', 'formTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

     public function store(Request $request)
     {
         $request->validate([
             'toEmails.*.*' => 'email|nullable',
             'ccEmails.*.*' => 'email|nullable',
             'bccEmails.*.*' => 'email|nullable',
             'emailTypes.*.*' => 'nullable|string',
             'form_type_name' => 'required|array',  
             'form_type_name.*' => 'exists:form_type,id',  
         ]);
 
         $dynamicEmail = new DynamicEmail();
 
         $dynamicEmail->to_emails = isset($request->toEmails) 
             ? implode(',', $this->flattenArray($request->toEmails)) 
             : null;
 
         $dynamicEmail->cc_emails = isset($request->ccEmails) 
             ? implode(',', $this->flattenArray($request->ccEmails)) 
             : null;
 
         $dynamicEmail->bcc_emails = isset($request->bccEmails) 
             ? implode(',', $this->flattenArray($request->bccEmails)) 
             : null;
 
         $dynamicEmail->email_types = isset($request->emailTypes) 
             ? implode(',', $this->flattenArray($request->emailTypes)) 
             : null;
 
         $dynamicEmail->form_type_id = implode(',', $request->form_type_name); 
 
         $dynamicEmail->save();
 
         return redirect()->route('admin.dynamic-email.index');
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
        $dynamicEmail = DynamicEmail::find($id);
        $formTypes = Formtype::get(); 

    return view('admin.dynamic-email.edit', compact('dynamicEmail', 'formTypes'));
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
        $request->validate([
            'toEmails' => 'required|array',
            'toEmails.*' => 'email',
            'ccEmails' => 'nullable|array|min:1',
            'ccEmails.*' => 'email',
            'bccEmails' => 'nullable|array|min:1',
            'bccEmails.*' => 'email',
            'emailTypes' => 'nullable|array',
            'emailTypes.*' => 'string',
            'form_type_id' => 'required|array', 
        ]);
    
        $dynamicEmail = Dynamicemail::findOrFail($id);
    
        $formTypeIds = implode(',', $request->form_type_id);
    
        $dynamicEmail->update([
            'to_emails' => implode(',', $request->toEmails),
            'cc_emails' => implode(',', $request->ccEmails),
            'bcc_emails' => implode(',', $request->bccEmails),
            'email_types' => implode(',', $request->emailTypes),
            'form_type_id' => $formTypeIds,  
        ]);
    
        return redirect()->route('admin.dynamic-email.index')->with('success', 'Dynamic email updated successfully.');
    }
    


/**
 * Helper function to flatten nested arrays.
 *
 * @param mixed $array
 * @return array
 */
private function flattenArray($array)
{
    if (!is_array($array)) {
        return [];
    }

    $flattened = [];
    array_walk_recursive($array, function ($value) use (&$flattened) {
        $flattened[] = $value;
    });

    return $flattened;
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dynamicemails = Dynamicemail::findOrFail($id); 
     
        //  if (!Gate::allows('subcategories_manage')) {
        //      return abort(401);
        //  }
     
         try {
             $dynamicemails->delete();
             return redirect()->route('admin.dynamic-email.index');
         } catch (\Exception $e) {
             \Log::error('Failed to delete dynamic email: ' . $e->getMessage());
             return response()->json(['message' => 'Failed to delete case study'], 500);
         }
    }
}
