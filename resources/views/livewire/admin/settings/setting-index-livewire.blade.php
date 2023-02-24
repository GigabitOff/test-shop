<div class="container-large">
    <div wire:ignore>
        @livewire('admin.partials.header-livewire', ['title' => (isset($title) ? $title : '')], key('header-livewire'))
    </div>
    <div class="accordion accordion-setting">

        @foreach($sections as $key => $section)
        @if($key != 'departments')
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" wire:ignore.self
                            data-bs-target="#collapse-{{$loop->iteration}}"
                            data-bs-toggle="collapse"
                            type="button">
                        {{$section['title']}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse" wire:ignore.self
                     id="collapse-{{$loop->iteration}}">
                    <div class="accordion-body" title="{{$key}}" wire:ignore.self>
                        @include("livewire.admin.settings.includes.index-$key")
                    </div>
                </div>
            </div>
        @endif
        @endforeach

    </div>

    <div class="mt-4">
        @include('livewire.admin.includes.save-data-include',[
            'wire_click'=>'SaveDataAll',
            'on_click'=>"emit('saveTmpDataContuct')",
            'onclick_cansel'=>'refresh',
            'title_button'=>__('custom::admin.Save')
            ])
    </div>

</div>
