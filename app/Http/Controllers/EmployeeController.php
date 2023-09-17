<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->has('search')){
            $data = Employee::where('name','LIKE','%' . $request->search . '%')
                    ->orWhere('email','LIKE','%' . $request->search . '%')
                    ->orWhere('profesi_status','LIKE','%' . $request->search . '%')->paginate(10);
        }else{
            $data = Employee::paginate(10);
        }

        

        return view('Home.backend.Employee.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Home.backend.Employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'name' => 'required|min:3',
            'no_hp'=> 'required',
            'address'=>'required|min:5',
            'email'=>'required',
            'profesi_status'=>'required'
        ],[
            'name.required' => 'nama karyawan belum terisi',
            'name.min'     => 'nama kategori minimal 3 huruf',

            'no_hp.required'=>'no handphone harus diisi',
        

            'address.required'=>'address harus diisi',
            'address.min'=>'address minimal 5 huruf',

            'email.required'=>'email harus diisi',
            'profesi_status.required'=>'profesi_status harus diisi',

        ])->validate();

       $data = $request->all();
     Employee::create($data);

     return redirect()->back()->with(['success'=>'Data Berhasil Tersimpan']);


    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('Home.backend.Employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee,$id)
    {
        Validator::make($request->all(),[
            'name' => 'required|min:3',
            'no_hp'=> 'required',
            'address'=>'required|min:5',
            'email'=>'required',
            'profesi_status'=>'required'
        ],[
            'name.required' => 'nama karyawan belum terisi',
          
            'name.min'     => 'nama kategori minimal 3 huruf',

            'no_hp.required'=>'no handphone harus diisi',
     

            'address.required'=>'address harus diisi',
            'address.min'=>'address minimal 5 huruf',

            'email.required'=>'email harus diisi',
            'profesi_status.required'=>'profesi_status harus diisi',

        ])->validate();
        

        $data = Employee::find($id);
        $data->name = $request->name;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->profesi_status = $request->profesi_status;

        $data->save();

        return redirect()->route('employee',compact('data'))->with(['success'=>'Data berhasil di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->back()->with(['success'=>'Data berhasil di Hapus']);
    }
}
