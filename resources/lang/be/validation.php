<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'Вы павінны прыняць.',
    'accepted_if'          => 'The must be accepted when :other is :value.',
    'active_url'           => 'Поле утрымлівае несапраўдны URL.',
    'after'                => 'У полі павінна быць дата пасля :date.',
    'after_or_equal'       => 'павінна быць датай пасля або роўнай :date.',
    'alpha'                => 'Поле можа мець толькі літары.',
    'alpha_dash'           => 'Поле можа мець толькі літары, лічбы і злучок.',
    'alpha_num'            => 'Поле можа мець толькі літары і лічбы.',
    'array'                => 'Поле павінна быць масівам.',
    'before'               => 'У полі павінна быць дата да :date.',
    'before_or_equal'      => 'павінна быць датай да або роўнай :date.',
    'between'              => [
        'array'   => 'Колькасць элементаў у поле павінна быць паміж :min і :max.',
        'file'    => 'Памер файла ў поле павінен быць паміж :min і :max кілабайт.',
        'numeric' => 'Поле павінна быць паміж :min і :max.',
        'string'  => 'Колькасць сiмвалаў у поле павінна быць паміж :min і :max.',
    ],
    'boolean'              => 'Поле павінна мець значэнне лагічнага тыпу.',
    'confirmed'            => 'Поле не супадае з пацвярджэннем.',
    'current_password'     => 'The password is incorrect.',
    'date'                 => 'Поле не з\'яўляецца датай.',
    'date_equals'          => 'павінна быць датай, роўнай :date.',
    'date_format'          => 'Поле не адпавядае фармату :format.',
    'declined'             => 'The must be declined.',
    'declined_if'          => 'The must be declined when :other is :value.',
    'different'            => 'Палі і :other павінны адрознівацца.',
    'digits'               => 'Даўжыня лічбавага поля павінна быць :digits.',
    'digits_between'       => 'Даўжыня лічбавага поля павінна быць паміж :min і :max.',
    'dimensions'           => 'мае недапушчальныя памеры малюнка.',
    'distinct'             => 'Поле мае паўтаральнае значэнне.',
    'email'                => 'Поле павінна быць сапраўдным электронным адрасам.',
    'ends_with'            => 'павінен заканчвацца адным з наступных: :values.',
    'enum'                 => 'The selected is invalid.',
    'exists'               => 'Выбранае значэнне для некарэктна.',
    'file'                 => 'павінен быць файлам.',
    'filled'               => 'Поле абавязкова для запаўнення.',
    'gt'                   => [
        'array'   => 'The must have more than :value items.',
        'file'    => 'The must be greater than :value kilobytes.',
        'numeric' => 'The must be greater than :value.',
        'string'  => 'The must be greater than :value characters.',
    ],
    'gte'                  => [
        'array'   => 'The must have :value items or more.',
        'file'    => 'The must be greater than or equal :value kilobytes.',
        'numeric' => 'The must be greater than or equal :value.',
        'string'  => 'The must be greater than or equal :value characters.',
    ],
    'image'                => 'Поле павінна быць малюнкам.',
    'in'                   => 'Выбранае значэнне для памылкова.',
    'in_array'             => 'Поле не існуе ў :other.',
    'integer'              => 'Поле павінна быць цэлым лікам.',
    'ip'                   => 'Поле дпавінна быць сапраўдным IP-адрасам.',
    'ipv4'                 => 'павінен быць сапраўдным IPv4-адрасам.',
    'ipv6'                 => 'павінен быць сапраўдным IPv6-адрасам.',
    'json'                 => 'Поле павінна быць JSON радком.',
    'lt'                   => [
        'array'   => 'The must have less than :value items.',
        'file'    => 'The must be less than :value kilobytes.',
        'numeric' => 'The must be less than :value.',
        'string'  => 'The must be less than :value characters.',
    ],
    'lte'                  => [
        'array'   => 'The must not have more than :value items.',
        'file'    => 'The must be less than or equal :value kilobytes.',
        'numeric' => 'The must be less than or equal :value.',
        'string'  => 'The must be less than or equal :value characters.',
    ],
    'mac_address'          => 'The must be a valid MAC address.',
    'max'                  => [
        'array'   => 'Колькасць элементаў у поле не можа перавышаць :max.',
        'file'    => 'Памер файла ў поле не можа быць больш :max кілабайт).',
        'numeric' => 'Поле не можа быць больш :max.',
        'string'  => 'Колькасць сiмвалаў у поле не можа перавышаць :max.',
    ],
    'mimes'                => 'Поле павінна быць файлам аднаго з наступных тыпаў: :values.',
    'mimetypes'            => 'Поле павінна быць файлам аднаго з наступных тыпаў: :values.',
    'min'                  => [
        'array'   => 'Колькасць элементаў у поле павінна быць не менш :min.',
        'file'    => 'Памер файла ў полее павінен быць не менш :min кілабайт.',
        'numeric' => 'Поле павінна быць не менш :min.',
        'string'  => 'Колькасць сiмвалаў у поле павінна быць не менш :min.',
    ],
    'multiple_of'          => 'Лік павінна быць Кратна :value',
    'not_in'               => 'Выбранае значэнне для памылкова.',
    'not_regex'            => 'Фармат недапушчальны.',
    'numeric'              => 'Поле павінна быць лікам.',
    'password'             => 'Пароль няправільны.',
    'present'              => 'Поле павінна прысутнічаць.',
    'prohibited'           => 'Поле забаронена.',
    'prohibited_if'        => 'Поле забаронена, калі :other роўна :value.',
    'prohibited_unless'    => 'Поле забаронена, калі толькі :other не знаходзіцца ў :values.',
    'prohibits'            => 'The field prohibits :other from being present.',
    'regex'                => 'Поле мае памылковы фармат.',
    'required'             => 'Поле абавязкова для запаўнення.',
    'required_array_keys'  => 'The field must contain entries for: :values.',
    'required_if'          => 'Поле абавязкова для запаўнення, калі :other раўняецца :value.',
    'required_unless'      => 'Поле абавязкова для запаўнення, калі :other не раўняецца :values.',
    'required_with'        => 'Поле абавязкова для запаўнення, калі :values ўказана.',
    'required_with_all'    => 'Поле абавязкова для запаўнення, калі :values ўказана.',
    'required_without'     => 'Поле абавязкова для запаўнення, калі :values не ўказана.',
    'required_without_all' => 'Поле абавязкова для запаўнення, калі ні адно з :values не ўказана.',
    'same'                 => 'Значэнне павінна супадаць з :other.',
    'size'                 => [
        'array'   => 'Колькасць элементаў у поле павінна быць :size.',
        'file'    => 'Размер файла павінен быць :size кілабайт.',
        'numeric' => 'Поле павінна быць :size.',
        'string'  => 'Колькасць сiмвалаў у поле павінна быць :size.',
    ],
    'starts_with'          => 'павінен пачынацца з аднаго з наступных значэнняў: :values.',
    'string'               => 'Поле павінна быць радком.',
    'timezone'             => 'Поле павінна быць сапраўдным гадзінным поясам.',
    'unique'               => 'Такое значэнне поля ўжо існуе.',
    'uploaded'             => 'не ўдалося загрузіць.',
    'url'                  => 'Поле мае памылковы фармат.',
    'uuid'                 => 'павінен быць сапраўдным UUID.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
];
