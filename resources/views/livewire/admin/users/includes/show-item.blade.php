{{--<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show)  AND $collapse_show==='all-info')active @endif" data-bs-toggle="tab"  data-bs-target="#all-info" type="button" role="tab">
            @lang('custom::admin.By list')
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show==='dependency')active @endif" data-bs-toggle="tab" data-bs-target="#dependency" type="button" role="tab" >
            @lang('custom::admin.Dependency')
        </button>
    </li>
</ul>
<div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel" onclick="@this.selectTab('all-info')">
--}}
@include('livewire.admin.users.includes.tablist.show-item-tablist-list')

{{--
    </div>
    <div class="tab-content">

    <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='dependency')show active @endif" id="dependency" role="tabpanel" onclick="@this.selectTab('dependency')">
        @include('livewire.admin.users.includes.tablist.show-item-tablist-dependency')
    </div>
</div>--}}
