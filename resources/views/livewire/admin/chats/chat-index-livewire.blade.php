<div class="container-large">
<div class="mt-4">
            <div class="table-before-btn --small"><button class="button button-accent button-small button-icon ico_plus" type="button" data-bs-target="#m-new-message" data-bs-toggle="modal"></button></div>
            <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.admin.chats.includes.index-footable-render')
        </div>
        <table wire:ignore id="footable-holder" class="users-table table-td-small"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>
          </div>
          @include('livewire.includes.per-page-footable', ['paginator' => $chats])

{{--<div class="lk-page__content">
    <h1 class="lk-page__title">@lang('custom::site.message')</h1>
    <div class="lk-page__action">
        <div></div>
        <div class="lk-page__action-btns">
            <a class="button-outline" href="#m-new-message"
               data-bs-toggle="modal">@lang('custom::site.write_message')</a></div>
    </div>
    <div class="lk-page__table">
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.admin.chats.includes.index-footable-render')
        </div>
        <table wire:ignore id="footable-holder"
               class="users-table table-td-small"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

    </div>
    <div class="lk-page__table-after">
        <div></div>
        @include('livewire.includes.per-page-footable', ['paginator' => $chats])
    </div>
</div>--}}
    <div class="modal fade" id="m-new-message" tabindex="-1" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        @include('livewire.admin.chats.includes.popup-new-message')
      </div>
    </div>

<script>
function changeOwnerStatus(id)
        {
            @this.setCloseItem(id);
        }
        </script>
</div>
