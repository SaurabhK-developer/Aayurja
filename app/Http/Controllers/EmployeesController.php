
<?php
namespace App\Http\Controllers\Admin;


use App\product;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Gallery;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;

class EmployeesController extends Controller
{


public function fileImportExport()
    {
       return view('website.file-import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new ImportEmployee, $request->file('file')->store('temp'));
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport(Request $request) 
    {        
        return Excel::download(new ExportEmployee, 'employee-collection.xlsx');
    }
    
}