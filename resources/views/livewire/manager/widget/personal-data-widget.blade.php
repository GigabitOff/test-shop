<div>
    <div class="lk-widjet__title">{{__('custom::site.personal_data')}}</div>
    <div class="lk-widjet__body">
        <ul class="lk-widjet__list">
            <li>
                <div><a class="lk-widjet__list-title" href="#!">{{$name}}</a>
                    <ul>
                        <li>{{$email}}</li>
                        <li>{{$phone}}</li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="lk-widjet__list-links">
            <li><a href="#modal-change-data-manager" data-toggle="modal">{{__('custom::site.personal_data_change')}}</a></li>
            <li><a href="#modal-change-password" data-toggle="modal">{{__('custom::site.password_change')}}</a></li>
        </ul>
    </div>
</div>
