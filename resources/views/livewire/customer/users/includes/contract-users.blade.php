@php
    $users = $contract->customers->sortByDesc->is_admin;
@endphp
@foreach($users as $user)
    <div class="dropdown-item">
        @if($user->is_admin)<span class="ico_star"></span>@endif
        <span class="dropdown-item__text"
              title="{{$user->name}}">{{$user->name}}</span>
        @if(! $user->is_admin)
            <span class="ico_close"
                  onclick="Livewire.emit('eventDetachUserFromContract',{customer_id:{{$user->id}}, contract_id:{{$contract->id}} })"
            ></span>
        @endif
    </div>
@endforeach
