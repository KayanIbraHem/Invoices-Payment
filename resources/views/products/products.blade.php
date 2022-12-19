@extends('layouts.master')
@section('title')
المنتجات
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافه مُنتج</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
				<!--Start Table-->	
				<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
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

									@if (session('edit'))
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>{{ session('edit') }}</strong>
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
								<a class="modal-effect btn btn-primary-gradient " data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة مُنتج</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1" data-page-length="50">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">اسم المنتج</th>
												<th class="wd-20p border-bottom-0">اسم القسم</th>
												<th class="wd-15p border-bottom-0">ملاحظات</th>
												<th class="wd-25p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@php $productID=1 @endphp
											@foreach($products as $product)
											<tr>	
												<td>{{$productID++}}</td>
												<td>{{$product->product_name}}</td>
												<td>{{$product->section->section_name}}</td>
												<td>{{$product->description}}</td>
												<td>
													<button class="btn btn-outline-success btn-sm"
														data-name="{{$product->product_name}}" data-id="{{$product->id}}"
														data-section_name="{{$product->section->section_name}}"
														data-description="{{$product->description}}" data-toggle="modal"
														data-target="#edit_Product">تعديل</button>

													<button class="btn btn-outline-danger btn-sm " data-pro_id=""
														data-product_name="" data-toggle="modal"
														data-target="#id{{$product->id}}">حذف</button>
												</td>
											</tr>
											<!-- delete -->
											<div class="modal" id="id{{$product->id}}">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content modal-content-demo">
														<div class="modal-header">
															<h6 class="modal-title">حذف القسم</h6><button aria-label="Close"
																class="close" data-dismiss="modal" type="button"><span
																	aria-hidden="true">&times;</span></button>
														</div>
														<form action="{{ route('products.destroy', ['product' => $product->id]) }}"
															method="post">
															@method('delete')

															@csrf
															<div class="modal-body">
																<p>هل انت متاكد من عملية الحذف ؟</p><br>

															</div>
															<div class="modal-footer">
																<button type="submit"
																	class="btn btn-success-gradient">تاكيد</button>
																<button type="button" class="btn btn-dark-gradient"
																	data-dismiss="modal">اغلاق</button>
															</div>
													</div>
													</form>
												</div>
											</div>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<!--End Table-->
				 <!-- edit -->
				 <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="{{route('products.update','id')}}" method="post" autocomplete="off">
									@csrf
									@method('put')

									<div class="form-group">
										<input type="hidden" name="id" id="id" value="">
										<label for="recipient-name" class="col-form-label">اسم المنتج:</label>
										<input class="form-control" name="product_name" id="product_name" type="text">
									</div>
									<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
									<select name="section_name" id="section_name" class="form-control" required>
										<option value="" selected disabled> --حدد القسم--</option>
										@foreach ($sections as $section)
											<option value="{{$section->id}}">{{$section->section_name}}</option>
										@endforeach
									</select>
									<div class="form-group">
										<label for="message-text" class="col-form-label">ملاحظات:</label>
										<textarea class="form-control" id="description" name="description" ></textarea>
									</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success-gradient">تاكيد</button>
								<button type="button" class="btn btn-dark-gradient" data-dismiss="modal">اغلاق</button>
							</div>
							</form>
						</div>
					</div>
				</div>
				<!-- add -->
					<div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{ route('products.store') }}" method="post">
									@csrf
									<div class="modal-body">
										<div class="form-group">
											<label for="exampleInputEmail1">اسم المنتج</label>
											<input type="text" class="form-control" id="Product_name" name="product_name" required>
										</div>

										<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
										<select name="section_name" id="section_id" class="form-control" required>
											<option value="" selected disabled> --حدد القسم--</option>
											@foreach ($sections as $section)
												<option value="{{ $section->id }}">{{ $section->section_name }}</option>
											@endforeach
										</select>

										<div class="form-group">
											<label for="exampleFormControlTextarea1">ملاحظات</label>
											<textarea class="form-control" id="description" name="description" rows="3"></textarea>
										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">تاكيد</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('name')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>
@endsection