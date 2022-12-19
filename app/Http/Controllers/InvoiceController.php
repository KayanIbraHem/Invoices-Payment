<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\sections;
use App\Models\InvoiceDetail;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.invoices',[
            'invoices'=>Invoice::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create',
        [
        'sections'=>sections::all()    
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Invoice $invoice,Request $request)
    {
        $invoice->invoice_number=$request->invoice_number;
        $invoice->invoice_date=$request->invoice_Date;
        $invoice->due_date=$request->Due_date;
        $invoice->product=$request->product;
        $invoice->section_id=$request->Section;
        $invoice->amount_collection=$request->Amount_collection;
        $invoice->amount_commission=$request->Amount_Commission;
        $invoice->discount=$request->Discount;
        $invoice->rate_vat=$request->Rate_VAT;
        $invoice->value_vat=$request->Value_VAT;
        $invoice->total=$request->Total;
        $invoice->status='غير مدفوعة';
        $invoice->value_status=2;
        $invoice->note=$request->note;
        $invoice->user=\Auth::user()->name;
        $invoice->save();

        $invoiceDetail=new InvoiceDetail();
        $invoice_id=Invoice::latest()->first()->id;
        $invoiceDetail->invoice_id=$invoice_id;
        $invoiceDetail->invoice_number=$request->invoice_number;
        $invoiceDetail->product=$request->product;
        $invoiceDetail->section=$request->Section;
        $invoiceDetail->status='غير مدفوعة';
        $invoiceDetail->value_status=2;
        $invoiceDetail->user=\Auth::user()->name;
        $invoiceDetail->save();

        if ($request->hasFile('pic')) {
            $invoice_id = Invoice::latest()->first()->id;
            $file = $request->file('pic');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachment = new InvoiceAttachment();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $invoice_number;
            $attachment->created_by = \Auth::user()->name;
            $attachment->invoice_id = $invoice_id;
            $attachment->save();
            $fileName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $fileName);
        }

        return back()->with('Add','تمت الاضافة');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function getProducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        // dd($products);
        return response()->json($products);

    }
}
