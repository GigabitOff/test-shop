<div class="container-medium mb-3" >
    
    <div class="uploads-widjet row g-3">
        <div class="col-md-8">
            <div class="uploads-widjet row g-3">
                <div class="col-md-3 col-6">
                    <div class="uploads-box">
                        <label><input type="file" id="pageImage-instruction" wire:model="data.instructions" multiple><span class="ico_add"></span></label>
                    </div>
                </div>
                @if(isset($product_instruction) AND count($product_instruction)>0)
                    @foreach ($product_instruction as $key_ph => $photo)
                    @if(!isset($instruction_dell_tmp[$photo->id]))
                        @include('livewire.admin.includes.add-instruction',[
                            'index'=>'instruction_'.$photo->id,
                            'key'=>'instruction',
                            'data'=>['instruction_'.$photo->id=>$photo->url],
                            'input_dell_wire'=>'wire:click=deleteInstructionItemTmp('.$photo->id.')'])
                    @endif
                    @endforeach
                @endif

                @if(isset($data['item_instr']))
                    @foreach ($data['item_instr'] as $key_tmp => $item_tmp)
                    @include('livewire.admin.includes.add-instruction',[
                            'index'=>'instruction_tmp_'.$key_tmp,
                            'key'=>'instruction',
                            'data_tmp'=>$item_tmp,
                            'input_dell_wire'=>'wire:click=deleteInstructionItemTmp('.$key_tmp.',"key_tmp")'])
                    @endforeach
                @endif

            </div>
        </div>

    </div>

</div>
