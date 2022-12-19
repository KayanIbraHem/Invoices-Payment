<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices=Invoice::where('id',$id)->first();
        $invoiceDetails=InvoiceDetail::where('invoice_id',$id)->get();
        $attachments=InvoiceAttachment::where('invoice_id',$id)->get();

        return view('invoices.invoiceDetail',[
            'invoice'=>$invoices,
            'invoiceDetail'=>$invoiceDetails,
            'attachment'=>$attachments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = InvoiceAttachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('viewfile')->delete($request->invoice_number.'/'.$request->file_name);
    
        return back()->with('delete', 'تم حذف المرفق بنجاح');
    }
    public function viewFile($number,$name)
    {
        $viewFile = Storage::disk('viewfile')->getDriver()->getAdapter()->applyPathPrefix($number.'/'.$name);
        return response()->file($viewFile);
    }
    public function downloadFile($number,$name)
    {
        $downloadFile= Storage::disk('viewfile')->getDriver()->getAdapter()->applyPathPrefix($number.'/'.$name);
        return response()->download( $downloadFile);
    }
}
