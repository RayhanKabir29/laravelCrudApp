<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Session;

class CrudController extends Controller
{
    public function showData()
    {   $showData = Crud::paginate(4);
        return view('show_data', compact('showData'));
    }
    public function addData()
    {
        return view('add_data');
    }
    public function storeData(Request $request)
    {
        $validData = [
            'name' => 'required|max:20',
            'email'=>'required|email'
        ];
        $customMessage = [
            'name.required' => "Enter Your Name",
            'name.max' => "Your Name can not exceed 20 characters",
            'email.required' => "Enter Your Email",
            'email.email'=> "Pleas enter your valid email address"

        ];
        $this->validate($request, $validData, $customMessage);
        $crud = new Crud();
        $crud-> name = $request->name;
        $crud-> email = $request->email;
        $crud-> save();
        Session::flash('success', 'Data saved successfully');
        return redirect('/');
    }
    public function editData($id=null){
        $editData = Crud::find($id);
        return view('edit_data', compact('editData'));
    }
    public function updateData(Request $request, $id)
    {
        $validData = [
            'name' => 'required|max:20',
            'email'=>'required|email'
        ];
        $customMessage = [
            'name.required' => "Enter Your Name",
            'name.max' => "Your Name can not exceed 20 characters",
            'email.required' => "Enter Your Email",
            'email.email'=> "Pleas enter your valid email address"

        ];
        $this->validate($request, $validData, $customMessage);
        $crud =  Crud::find($id);
        $crud-> name = $request->name;
        $crud-> email = $request->email;
        $crud-> save();
        Session::flash('success', 'Data Update successfully');
        return redirect('/');
    }
    public function deleteData($id=null){
        $deleteData = Crud::find($id);
        $deleteData -> delete();
        Session::flash('success', 'Delete data successfully');
        return redirect('/');
    }
}
