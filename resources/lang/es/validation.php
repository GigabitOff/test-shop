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
    'accepted'             => ':attribute debe ser aceptado.',
    'accepted_if'          => ':attribute debe ser aceptado cuando :other sea :value.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => ':attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => ':attribute sólo debe contener letras.',
    'alpha_dash'           => ':attribute sólo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => ':attribute sólo debe contener letras y números.',
    'array'                => ':attribute debe ser un conjunto.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => ':attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'array'   => ':attribute tiene que tener entre :min - :max elementos.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
    ],
    'boolean'              => 'El campo debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de no coincide.',
    'current_password'     => 'La contraseña es incorrecta.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_equals'          => ':attribute debe ser una fecha igual a :date.',
    'date_format'          => ':attribute no corresponde al formato :format.',
    'declined'             => ':attribute debe ser rechazado.',
    'declined_if'          => ':attribute debe ser rechazado cuando :other sea :value.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen no son válidas.',
    'distinct'             => 'El campo contiene un valor duplicado.',
    'email'                => ':attribute no es un correo válido.',
    'ends_with'            => 'El campo debe finalizar con uno de los siguientes valores: :values',
    'enum'                 => 'El seleccionado es inválido.',
    'exists'               => 'El seleccionado es inválido.',
    'file'                 => 'El campo debe ser un archivo.',
    'filled'               => 'El campo es obligatorio.',
    'gt'                   => [
        'array'   => 'El campo debe tener más de :value elementos.',
        'file'    => 'El campo debe tener más de :value kilobytes.',
        'numeric' => 'El campo debe ser mayor que :value.',
        'string'  => 'El campo debe tener más de :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'El campo debe tener como mínimo :value elementos.',
        'file'    => 'El campo debe tener como mínimo :value kilobytes.',
        'numeric' => 'El campo debe ser como mínimo :value.',
        'string'  => 'El campo debe tener como mínimo :value caracteres.',
    ],
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute es inválido.',
    'in_array'             => 'El campo no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'ipv4'                 => ':attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => ':attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El campo debe ser una cadena JSON válida.',
    'lt'                   => [
        'array'   => 'El campo debe tener menos de :value elementos.',
        'file'    => 'El campo debe tener menos de :value kilobytes.',
        'numeric' => 'El campo debe ser menor que :value.',
        'string'  => 'El campo debe tener menos de :value caracteres.',
    ],
    'lte'                  => [
        'array'   => 'El campo debe tener como máximo :value elementos.',
        'file'    => 'El campo debe tener como máximo :value kilobytes.',
        'numeric' => 'El campo debe ser como máximo :value.',
        'string'  => 'El campo debe tener como máximo :value caracteres.',
    ],
    'mac_address'          => 'El campo debe ser una dirección MAC válida.',
    'max'                  => [
        'array'   => ':attribute no debe tener más de :max elementos.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        'numeric' => ':attribute no debe ser mayor que :max.',
        'string'  => ':attribute no debe ser mayor que :max caracteres.',
    ],
    'mimes'                => ':attribute debe ser un archivo con formato: :values.',
    'mimetypes'            => ':attribute debe ser un archivo con formato: :values.',
    'min'                  => [
        'array'   => ':attribute debe tener al menos :min elementos.',
        'file'    => 'El tamaño de debe ser de al menos :min kilobytes.',
        'numeric' => 'El tamaño de debe ser de al menos :min.',
        'string'  => ':attribute debe contener al menos :min caracteres.',
    ],
    'multiple_of'          => 'El campo debe ser múltiplo de :value',
    'not_in'               => ':attribute es inválido.',
    'not_regex'            => 'El formato del campo no es válido.',
    'numeric'              => ':attribute debe ser numérico.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo debe estar presente.',
    'prohibited'           => 'El campo está prohibido.',
    'prohibited_if'        => 'El campo está prohibido cuando :other es :value.',
    'prohibited_unless'    => 'El campo está prohibido a menos que :other sea :values.',
    'prohibits'            => 'El campo prohibe que :other esté presente.',
    'regex'                => 'El formato de es inválido.',
    'required'             => 'El campo es obligatorio.',
    'required_array_keys'  => 'El campo debe contener entradas para: :values.',
    'required_if'          => 'El campo es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo es obligatorio cuando :values están presentes.',
    'required_without'     => 'El campo es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo es obligatorio cuando ninguno de :values está presente.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'array'   => ':attribute debe contener :size elementos.',
        'file'    => 'El tamaño de debe ser :size kilobytes.',
        'numeric' => 'El tamaño de debe ser :size.',
        'string'  => ':attribute debe contener :size caracteres.',
    ],
    'starts_with'          => 'El campo debe comenzar con uno de los siguientes valores: :values',
    'string'               => 'El campo debe ser una cadena de caracteres.',
    'timezone'             => ':Attribute debe ser una zona horaria válida.',
    'unique'               => 'El campo ya ha sido registrado.',
    'uploaded'             => 'Subir ha fallado.',
    'url'                  => ':Attribute debe ser una URL válida.',
    'uuid'                 => 'El campo debe ser un UUID válido.',
    'custom'               => [
        'email'    => [
            'unique' => 'El ya ha sido registrado.',
        ],
        'password' => [
            'min' => 'La debe contener más de :min caracteres',
        ],
    ],
];
