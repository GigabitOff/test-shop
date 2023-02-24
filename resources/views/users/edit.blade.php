@extends('layouts.admin')

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="container">
                    <a href="{{ route('admin.actions.index',['lang' => app()->getLocale()]) }}" class="return_link">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('custom::site.Come back')
                    </a>
                </div>
                <h1 class="m-1 text-dark">@lang('custom::admin.Actions edit')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.actions.index') }}">@lang('custom::admin.Actions')</a></li>
                    <li class="breadcrumb-item active">@lang('custom::admin.Actions edit')</li>
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
                @livewire('admin.actions.action-edit-livewire', ['item_id'=>$id], key(time().'action-edit'))
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
