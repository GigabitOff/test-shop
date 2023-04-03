<div class="container-large mb-3" >

    <div class="row g-4">
        <div class="col-12">

                    <div class="uploads-box upload-instructions-input"><label><input type="file" wire:model="data.instructions" multiple accept="application/pdf"><span class="ico_add"></span></label></div>

        </div>

    </div>
    <div class="row g-4 mt-0 upload-instructions-wrapper">
       {{--  @if(isset($product_instruction) AND count($product_instruction)>0)
                   @foreach ($product_instruction as $key_ph => $photo)
                    @if(!isset($instruction_dell_tmp[$photo->id]))
                        @include('livewire.admin.includes.add-instruction',[
                            'index'=>'instruction_'.$photo->id,
                            'key'=>'instruction',
                            'description'=>$photo->file_description,
                            'data_instruction' => $photo,
                            'data'=>['instruction_'.$photo->id=>$photo->url],
                    'input_dell_wire'=>'wire:click=deleteInstructionItemTmp('.$photo->id.')'])
                    @endif
                    @endforeach
                @endif--}}

                @if(isset($data['item_instr']) AND count($data['item_instr'])>0)
                    @foreach ($data['item_instr'] as $key_tmp => $item_tmp)
                    @include('livewire.admin.includes.add-instruction',[
                            'index'=>$key_tmp,
                            'key'=>'instruction',
                            'data_it'=>$item_tmp,
                            ])
                    @endforeach
                @endif
            </div>

</div>
