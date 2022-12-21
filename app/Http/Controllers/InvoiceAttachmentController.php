<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'file_name'=>'mimes:pdf,jpg,jpeg,png'
        ],
        [
            'file_name.mimes'=>'صيغه الملف غير مدعومة' 
        ]);
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $file_name = $file->getClientOriginalName();
            $attachment = new InvoiceAttachment();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $request->invoice_number;
            $attachment->created_by = \Auth::user()->name;
            $attachment->invoice_id = $request->invoice_id;
            $attachment->save();    
            $fileName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/' .  $request->invoice_number), $fileName);
        }

        return back()->with('Add','تمت الاضافة');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceAttachment $invoiceAttachment)
    {
        //
    }
}
