<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionRequest;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sections.sections',['sections'=>sections::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        sections::create([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
            'created_by'=>(Auth::user()->name),    
        ]);
        return redirect('sections')->with('Add','تم اضافة القسم بنجاح ');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section_id=$request->id;
        $this->validate($request,[
            'section_name'=>'required|min:4|max:50|unique:sections,section_name,'.$section_id,
            'description'=>'required|min:10|max:255'
        ],[
            'section_name.required'=>'اسم القسم مطلوب',
            'section_name.unique'=>'اسم القسم موجود بالفعل!',
            'section_name.min'=>'يجب الا يقل الاسم عن اربعة حروف',
            'section_name.max'=>'يجب الا يتجاوز اسم القسم عن خمسين حرف',

            'description.required'=>'يجب اداخل وصف للقسم',
            'description.min'=>'يجب الا يقل وصف القسم عن عشرة حروف',
            'description.max'=>'يجب الا يزيد وصف القسم عن 255 حرف',
        ]
    );
        $section=sections::find($section_id);   
        $section->section_name=$request->section_name;
        $section->description=$request->description;
        $section->save();
        return redirect('sections')->with('edit','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $section)
    {
        
        $section->delete();
        return redirect('sections')->with('delete','تم حذف القسم');  
    }
}
