@extends('layer.master')
@section('pageTitle', 'Quản lý sinh viên')
@section('content')
<div class="card">
	@if(count($errors) > 0)
		<div class="alert alert-danger">
	     	<ul>
	     		@foreach($errors->all() as $error)
	      			<li>{{ $error }}</li>
	      		@endforeach
	     	</ul>
		</div>
	@endif
	@if($message = Session::get('success'))
   		<div class="alert alert-success alert-block">
    		<button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   		</div>
	@endif
   	<form method="post" enctype="multipart/form-data" action="{{ route('sinh_vien.import') }}">
    {{ csrf_field() }}
	    <div class="form-group">
	    	<h3 align="center" style="padding: 10px">Nhập sinh viên từ file excel</h3>
	     	<table class="table">
	      		<tr>
		       		<td width="40%" align="right">
		       			<label>Chọn file excel (.xls, .xlsx)</label>
		       		</td>
		       		<td width="30">
		        		<input type="file" name="select_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
		       		</td>
		       		<td width="30%" align="left">
		        		<input type="submit" name="upload" class="btn btn-primary btn-sm btn-fill" value="Tải lên">
		       		</td>
		      	</tr>
		      	<tr>
		       		<td width="20%" align="right"></td>
		       		<td width="50" align="left"></td>
		       		<td width="30%" align="left"></td>
		      	</tr>
		    </table>
		</div>
   	</form>
   	<div style="height: 6rem">	
   		<center>
	   		<button class='button_update btn btn-info btn-fill btn-wd center-block' onclick="location.href='{{ route('sinh_vien.view_all') }}'">Quay lại</button>
	   	</center>
   	</div>   	
</div>
@endsection