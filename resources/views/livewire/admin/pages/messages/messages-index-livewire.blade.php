<div class="container-large">
    {{-- Livewire About Admin --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.pages.index','title_lang'=>__('custom::admin.Return to list page')])
    <h4>@lang('custom::admin.Jobs')</h4>
    <div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
    <form class="--messages" action="#!">
            <div class="form-group">
              <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Пользователи (поиск по ID или Ф.И.О. пользователя)" />
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Пользователь 1</li>
                      <li class="drop-list-item">Пользователь 2</li>
                      <li class="drop-list-item">Пользователь 3</li>
                      <li class="drop-list-item">Пользователь 4</li>
                      <li class="drop-list-item">Пользователь 5</li>
                      <li class="drop-list-item">Пользователь 6</li>
                      <li class="drop-list-item">Пользователь 7</li>
                      <li class="drop-list-item">Пользователь 8</li>
                      <li class="drop-list-item">Пользователь 9</li>
                      <li class="drop-list-item">Пользователь 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="drop --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Тема"><button class="form-control drop-button" type="button">Тема</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Общий</li>
                      <li class="drop-list-item">Финансовый</li>
                      <li class="drop-list-item">Жалоба</li>
                      <li class="drop-list-item">Другое</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group"><textarea class="form-control" placeholder="Текст" style="height: 180px"></textarea></div>
            <div class="page-bottom-group">
              <div class="page-save"><button class="button" type="button" data-bs-target="#m-success-messages" data-bs-toggle="modal">Отправить</button></div>
            </div>
          </form>
</div>
