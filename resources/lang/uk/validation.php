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

    'accepted' => 'Ви повинні прийняти.',
    'accepted_if' => 'Ви повинні прийняти коли :other має значення :value.',
    'active_url' => 'Поле не є правильним URL.',
    'after' => 'Поле має містити дату не раніше :date.',
    'after_or_equal' => 'Поле має містити дату не раніше, або дорівнюватися :date.',
    'alpha' => 'Поле має містити лише літери.',
    'alpha_dash' => 'Поле має містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => 'Поле має містити лише літери та цифри.',
    'array' => 'Поле має бути масивом.',
    'before' => 'Поле має містити дату не пізніше :date.',
    'before_or_equal' => 'Поле має містити дату не пізніше, або дорівнюватися :date.',
    'between' => [
        'numeric' => 'Поле має бути між :min та :max.',
        'file' => 'Розмір файлу  має бути не менше :min та не більше :max кілобайт.',
        'string' => 'Текст має бути не менше :min та не більше :max символів.',
        'array' => 'Поле  має містити від :min до :max елементів.',
    ],
    'boolean' => 'Поле повинне містити логічний тип.',
    'confirmed' => 'Поле не збігається з підтвердженням.',
    'current_password' => 'Пароль не вірний.',
    'date' => 'Поле не є датою.',
    'date_equals' => 'Поле має бути датою рівною :date.',
    'date_format' => 'Поле не відповідає формату :format.',
    'different' => 'Поля та :other повинні бути різними.',
    'digits' => 'Довжина цифрового поля повинна дорівнювати :digits.',
    'digits_between' => 'Довжина цифрового поля повинна бути від :min до :max.',
    'dimensions' => 'Поле містить неприпустимі розміри зображення.',
    'distinct' => 'Поле містить значення, яке дублюється.',
    'email' => 'Поле повинне містити коректну електронну адресу.',
    'ends_with' => 'Поле має закінчуватися одним з наступних значень: :values',
    'exists' => 'Вибране для значення не коректне.',
    'file' => 'Поле має містити файл.',
    'filled' => "Поле є обов'язковим для заповнення.",
    'gt' => [
        'numeric' => 'Поле має бути більше ніж :value.',
        'file' => 'Поле має бути більше ніж :value кілобайт.',
        'string' => 'Поле має бути більше ніж :value символів.',
        'array' => 'Поле має містити більше ніж :value елементів.',
    ],
    'gte' => [
        'numeric' => 'Поле має дорівнювати чи бути більше ніж :value.',
        'file' => 'Поле має дорівнювати чи бути більше ніж :value кілобайт.',
        'string' => 'Поле має дорівнювати чи бути більше ніж :value символів.',
        'array' => 'Поле має містити :value чи більше елементів.',
    ],
    'image' => 'Поле має містити зображення.',
    'in' => 'Вибране для значення не коректне.',
    'in_array' => 'Значення поля не міститься в :other.',
    'integer' => 'Поле має містити ціле число.',
    'ip' => 'Поле має містити IP адресу.',
    'ipv4' => 'Поле має містити IPv4 адресу.',
    'ipv6' => 'Поле має містити IPv6 адресу.',
    'json' => 'Дані поля мають бути у форматі JSON.',
    'lt' => [
        'numeric' => 'Поле має бути менше ніж :value.',
        'file' => 'Поле має бути менше ніж :value кілобайт.',
        'string' => 'Поле має бути менше ніж :value символів.',
        'array' => 'Поле має містити менше ніж :value items.',
    ],
    'lte' => [
        'numeric' => 'Поле має дорівнювати чи бути менше ніж :value.',
        'file' => 'Поле має дорівнювати чи бути менше ніж :value кілобайт.',
        'string' => 'Поле має дорівнювати чи бути менше ніж :value символів.',
        'array' => 'Поле має містити не більше ніж :value елементів.',
    ],
    'max' => [
        'numeric' => 'Поле має бути не більше :max.',
        'file' => 'Файл в полі має бути не більше :max кілобайт.',
        'string' => 'Текст в полі повинен мати довжину не більшу за :max.',
        'array' => 'Поле повинне містити не більше :max елементів.',
    ],
    'mimes' => 'Поле повинне містити файл одного з типів: :values.',
    'mimetypes' => 'Поле повинне містити файл одного з типів: :values.',
    'min' => [
        'numeric' => 'Поле повинне бути не менше :min.',
        'file' => 'Розмір файлу має бути не меншим :min кілобайт.',
        'string' => 'Текст повинен містити не менше :min символів.',
        'array' => 'Поле повинне містити не менше :min елементів.',
    ],
    'multiple_of' => 'Поле повинне бути одним із :value.',
    'not_in' => 'Вибране для значення не коректне.',
    'not_regex' => 'Формат поля не вірний.',
    'numeric' => 'Поле повинно містити число.',
    'password' => 'Неправильний пароль.',
    'present' => 'Поле повинне бути присутнє.',
    'regex' => 'Поле має хибний формат.',
    'required' => "Поле є обов\'язковим для заповнення.",
    'required_if' => "Поле є обов\'язковим для заповнення, коли :other є рівним :value.",
    'required_unless' => "Поле є обов\'язковим для заповнення, коли :other відрізняється від :values",
    'required_with' => "Поле є обов\'язковим для заповнення, коли :values вказано.",
    'required_with_all' => "Поле є обов\'язковим для заповнення, коли :values вказано.",
    'required_without' => "Поле є обов\'язковим для заповнення, коли :values не вказано.",
    'required_without_all' => "Поле є обов\'язковим для заповнення, коли :values не вказано.",
    'prohibited' => 'Поле заборонено.',
    'prohibited_if' => 'The field is prohibited when :other is :value.',
    'prohibited_unless' => 'The field is prohibited unless :other is in :values.',
    'prohibits' => 'The field prohibits :other from being present.',
    'same' => 'Поля та :other мають збігатися.',
    'size' => [
        'numeric' => 'Поле має бути довжини :size.',
        'file' => 'Файл має бути розміром :size кілобайт.',
        'string' => 'Текст повинен містити :size символів.',
        'array' => 'Поле повинне містити :size елементів.',
    ],
    'starts_with' => 'Поле повинне починатися з одного з наступних значень: :values',
    'string' => 'Поле повинне містити текст.',
    'timezone' => 'Поле повинне містити коректну часову зону.',
    'unique' => 'Вказане значення поля вже існує.',
    'uploaded' => 'Завантаження не вдалося.',
    'url' => 'Формат поля хибний.',
    'uuid' => 'Поле має бути коректним UUID ідентифікатором.',
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
            'exists' => 'Користувача з цим номером не знайдено'
        ],
        'email' => [
            'exists' => 'Користувача з цим email не знайдено'
        ],
    ],

    'import' => [
        'delivery' => [
            'owner' => 'Власника не знайдено.',
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
        'fio' => 'П.І.Б',
        'data.phone' => 'Номер телефону',
        'data.rating' => 'Рейтинг',
        'data.text' => 'Повідомлення',
        'phone' => 'Номер телефону',
        'password' => 'Пароль',
        'privacy_policy' => 'політика конфіденційності',
    ],

];
