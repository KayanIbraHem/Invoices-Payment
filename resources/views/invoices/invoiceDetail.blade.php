@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
                   
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        <div class="row ">
            <div class="col-xl-12">
                <!-- div -->
                <div class="d-flex justify-content-between">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('Add') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card mg-b-20" id="tabs-style2">
                    <div class="card-body">
                        <div class="text-wrap">
                            <div class="example">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class=" tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs main-nav-line">
                                                <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                                                <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                                <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab4">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1" data-page-length="50">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                                <th class="border-bottom-0">المنتج</th>
                                                                <th class="border-bottom-0">القسم</th>
                                                                <th class="border-bottom-0">الخصم</th>
                                                                <th class="border-bottom-0">نسبة الضريبة</th>
                                                                <th class="border-bottom-0">قيمة الضريبة</th>
                                                                <th class="border-bottom-0">الاجمالي</th>
                                                                <th class="border-bottom-0">الحالة</th>
                                                                <th class="border-bottom-0">ملاحظات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                <tr>
                                                                    <td>{{$invoice->invoice_number}}</td>
                                                                    <td>{{$invoice->invoice_date}}</td>
                                                                    <td>{{$invoice->due_date}}</td>
                                                                    <td>{{$invoice->product}}</td>
                                                                    <td>{{$invoice->section->section_name}}</td>
                                                                    <td>{{$invoice->discount}}</td>
                                                                    <td>{{$invoice->rate_vat}}</td>
                                                                    <td>{{$invoice->value_vat}}</td>
                                                                    <td>{{$invoice->total}}</td>
                                                                    <td>
                                                                        @if($invoice->value_status == 1)
                                                                            <span class="badge badge-pill badge-success">مدفوعة</span>
                                                                        @elseif($invoice->value_status == 2)
                                                                            <span class="badge badge-pill badge-danger">غير مدفوعة</span>
                                                                        @elseif($invoice->value_status == 3)
                                                                        <span class="badge badge-pill badge-danger">مدفوعة جزئيا</span>
                                                                        @else
                                                                            <span class="badge badge-pill badge-warning">{{$invoice->status}}</span>	
                                                                        @endif	
                                                                    </td>
                                                                    <td>{{$invoice->note?$invoice->note:'لا توجد ملاحظات'}}</td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab5">
                                            <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1" data-page-length="50">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">#</th>
                                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                                <th class="border-bottom-0">المنتج</th>
                                                                <th class="border-bottom-0">القسم</th>
                                                                <th class="border-bottom-0">حالة الدفع</th>
                                                                <th class="border-bottom-0">تاريخ الدفع</th>
                                                                <th class="border-bottom-0">تاريخ الاضافة</th>
                                                                <th class="border-bottom-0">المستخدم</th>
                                                                <th class="border-bottom-0">ملاحظات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $invoiceID=1 @endphp
                                                            @foreach($invoiceDetail as $detail)
                                                                <tr>
                                                                    <td>{{$invoiceID++}}</td>
                                                                    <td>{{$detail->invoice_number}}</td>
                                                                    <td>{{$detail->product}}</td>
                                                                    <td>{{$invoice->section->section_name}}</td>
                                                                    <td>
                                                                        @if($detail->value_status == 1)
                                                                            <span class="badge badge-pill badge-success">مدفوعة</span>
                                                                        @elseif($detail->value_status == 2)
                                                                            <span class="badge badge-pill badge-danger">غير مدفوعة</span>
                                                                        @elseif($detail->value_status == 3)
                                                                        <span class="badge badge-pill badge-warning">مدفوعة جزئيا</span>
                                                                        @else
                                                                            <span class="badge badge-pill badge-warning">{{$detail->status}}</span>	
                                                                        @endif	
                                                                    </td>
                                                                    <td>{{$detail->payment_date}}</td>
                                                                    <td>{{$detail->created_at}}</td>
                                                                    <td>{{$detail->user}}</td>
                                                                    <td>{{$invoice->note?$invoice->note:'لا توجد ملاحظات'}}</td>
                                                                </tr>
                                                            @endforeach    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab6">
                                                <div class="card card-statistics">
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{route('invoicesattachments.store')}}"
                                                            enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoice->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoice->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                </div>
                                                <br>
                                            <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">#</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">المستخدم</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $attachID = 1; @endphp
                                                            @foreach ($attachment as $attach)
                                                                <tr>
                                                                    <td>{{ $attachID++ }}</td>
                                                                    <td>{{ $attach->file_name }}</td>
                                                                    <td>{{ $attach->created_at }}</td>
                                                                    <td>{{ $attach->created_by }}</td>
                                                                    <td colspan="2">
                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{route ('invoices.viewfile',
                                                                                            ['number'=>$invoice->invoice_number,
                                                                                            'name'=>$attach->file_name])}}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>
                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{route ('invoices.downloadfile',
                                                                                            ['number'=>$invoice->invoice_number,
                                                                                            'name'=>$attach->file_name])}}"
                                                                            role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>
                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"     
                                                                            data-file_name="{{ $attach->file_name }}"
                                                                            data-invoice_number="{{ $attach->invoice_number }}"
                                                                            data-id_file="{{ $attach->id }}"
                                                                            data-target="#delete_file">حذف</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- row closed -->
        <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('files.destroy')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>
                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- enddelete -->
    </div>
    <!-- Container closed -->
</div>
</div>
<!-- main-content closed -->
@endsection

@section('js')
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- Internal Input tags js-->
<script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
<!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
<!--Internal  Clipboard js-->
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
<!-- Internal Prism js-->
<script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
<script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection