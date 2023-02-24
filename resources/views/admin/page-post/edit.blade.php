@extends('layouts.admin')

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="container">
                    <a href="{{ url()->previous() }}" class="return_link">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('custom::site.Come back')
                    </a>
                </div>
                <h1 class="m-1 text-dark">@lang('custom::admin.Posts edit')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('custom::admin.Main')</a></li>
                    <li class="breadcrumb-item active">@lang('custom::admin.Posts edit')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                @livewire('admin.page-post.post-edit-livewire',['item_id'=>$id,'page_id'=>$page_id],
                key(time().'contuct-edit'))
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
