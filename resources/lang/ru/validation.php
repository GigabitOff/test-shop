<?php

return [

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

    'accepted' => 'Вы должны принять.',
    'accepted_if' => 'Вы должны принять когда :other имеет значение :value.',
    'active_url' => 'Поле содержит недействительный URL.',
    'after' => 'В поле должна быть дата больше :date.',
    'after_or_equal' => 'В поле должна быть дата больше или равняться :date.',
    'alpha' => 'Поле может содержать только буквы.',
    'alpha_dash' => 'Поле может содержать только буквы, цифры, дефис и нижнее подчеркивание.',
    'alpha_num' => 'Поле может содержать только буквы и цифры.',
    'array' => 'Поле должно быть массивом.',
    'before' => 'В поле должна быть дата раньше :date.',
    'before_or_equal' => 'В поле должна быть дата раньше или равняться :date.',
    'between' => [
        'numeric' => 'Поле должно быть между :min и :max.',
        'file' => 'Размер файла должен быть между :min и :max Килобайт(а).',
        'string' => 'Количество символов должно быть между :min и :max.',
        'array' => 'Количество элементов должно быть между :min и :max.',
    ],
    'boolean' => 'Поле должно иметь значение логического типа.',
    'confirmed' => 'Поле не совпадает с подтверждением.',
    'current_password' => 'Пароль не верный.',
    'date' => 'Поле не является датой.',
    'date_equals' => 'Поле должно быть датой равной :date.',
    'date_format' => 'Поле не соответствует формату.',
    'different' => 'Поля и :other должны различаться.',
    'digits' => 'Длина цифрового поля должна быть :digits.',
    'digits_between' => 'Длина цифрового поля должна быть между :min и :max.',
    'dimensions' => 'Поле имеет недопустимые размеры изображения.',
    'distinct' => 'Поле содержит повторяющееся значение.',
    'email' => 'Поле должно быть действительным электронным адресом.',
    'ends_with' => 'Поле должно заканчиваться одним из следующих значений: :values',
    'exists' => 'Выбранное значение для некорректно.',
    'file' => 'Поле должно быть файлом.',
    'filled' => 'Поле обязательно для заполнения.',
    'gt' => [
        'numeric' => 'Поле должно быть больше :value.',
        'file' => 'Размер файла должен быть больше :value Килобайт(а).',
        'string' => 'Количество символов должно быть больше :value.',
        'array' => 'Количество элементов должно быть больше :value.',
    ],
    'gte' => [
        'numeric' => 'Поле должно быть :value или больше.',
        'file' => 'Размер файла должен быть :value Килобайт(а) или больше.',
        'string' => 'Количество символов должно быть :value или больше.',
        'array' => 'Количество элементов должно быть :value или больше.',
    ],
    'image' => 'Поле должно быть изображением.',
    'in' => 'Выбранное значение для ошибочно.',
    'in_array' => 'Поле не существует в :other.',
    'integer' => 'Поле должно быть целым числом.',
    'ip' => 'Поле должно быть действительным IP-адресом.',
    'ipv4' => 'Поле должно быть действительным IPv4-адресом.',
    'ipv6' => 'Поле должно быть действительным IPv6-адресом.',
    'json' => 'Поле должно быть JSON строкой.',
    'lt' => [
        'numeric' => 'Поле должно быть меньше :value.',
        'file' => 'Размер файла должен быть меньше :value Килобайт(а).',
        'string' => 'Количество символов должно быть меньше :value.',
        'array' => 'Количество элементов должно быть меньше :value.',
    ],
    'lte' => [
        'numeric' => 'Поле должно быть :value или меньше.',
        'file' => 'Размер файла должен быть :value Килобайт(а) или меньше.',
        'string' => 'Количество символов должно быть :value или меньше.',
        'array' => 'Количество элементов должно быть :value или меньше.',
    ],
    'max' => [
        'numeric' => 'Поле не может быть больше :max.',
        'file' => 'Размер файла не может быть больше :max Килобайт(а).',
        'string' => 'Количество символов не может превышать :max.',
        'array' => 'Количество элементов не может превышать :max.',
    ],
    'mimes' => 'Поле должно быть файлом одного из следующих типов: :values.',
    'mimetypes' => 'Поле должно быть файлом одного из следующих типов: :values.',
    'min' => [
        'numeric' => 'Поле должно быть не меньше :min.',
        'file' => 'Размер файла должен быть не меньше :min Килобайт(а).',
        'string' => 'Количество символов должно быть не меньше :min.',
        'array' => 'Количество элементов должно быть не меньше :min.',
    ],
    'multiple_of' => 'Значение поля должно быть кратным :value',
    'not_in' => 'Выбранное значение для ошибочно.',
    'not_regex' => 'Выбранный формат для ошибочный.',
    'numeric' => 'Поле должно быть числом.',
    'password' => 'Неверный пароль.',
    'present' => 'Поле должно присутствовать.',
    'regex' => 'Поле имеет ошибочный формат.',
    'required' => 'Поле обязательно для заполнения.',
    'required_if' => 'Поле обязательно для заполнения, когда :other равно :value.',
    'required_unless' => 'Поле обязательно для заполнения, когда :other не равно :values.',
    'required_with' => 'Поле обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле обязательно для заполнения, когда :values указано.',
    'required_without' => 'Поле обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле обязательно для заполнения, когда ни одно из :values не указано.',
    'prohibited' => 'The field is prohibited.',
    'prohibited_if' => 'The field is prohibited when :other is :value.',
    'prohibited_unless' => 'The field is prohibited unless :other is in :values.',
    'prohibits' => 'The field prohibits :other from being present.',
    'same' => 'Значения полей и :other должны совпадать.',
    'size' => [
        'numeric' => 'Поле должно быть равным :size.',
        'file' => 'Размер файла должен быть равен :size Килобайт(а).',
        'string' => 'Количество символов должно быть равным :size.',
        'array' => 'Количество элементов должно быть равным :size.',
    ],
    'starts_with' => 'Поле должно начинаться из одного из следующих значений: :values',
    'string' => 'Поле должно быть строкой.',
    'timezone' => 'Поле должно быть действительным часовым поясом.',
    'unique' => 'Такое значение поля уже существует.',
    'uploaded' => 'Загрузка поля не удалась.',
    'url' => 'Поле имеет ошибочный формат URL.',
    'uuid' => 'Поле должно быть корректным UUID.',
    'owner' => 'The selected owner not found.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'phone' => [
            'exists' => 'Пользователь с таким номером не найден'
        ],
        'email' => [
            'exists' => 'Пользователь с таким email не найден'
        ]
    ],

    'import' => [
        'delivery' => [
            'owner' => 'Владелец не найден.',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'fio' => 'Ф.И.О',
        'phone' => 'Номер телефона',
        'password' => 'Пароль',
        'privacy_policy' => 'политика конфиденциальности',
    ],

];
