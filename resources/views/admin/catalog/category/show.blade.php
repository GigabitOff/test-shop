@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $category ? $category->title :'' }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('custom::admin.Main')</a></li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.product.category.index') }}">
                            @lang('custom::admin.Product Category')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $category ? $category->title :'' }}
                    </li>
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
                @livewire('admin.catalog.category.catalog-category-show-livewire',['category'=>$category],
                key(time().'catalog-category-show'))
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
