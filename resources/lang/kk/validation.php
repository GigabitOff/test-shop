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
    'accepted'             => ' қабылдануы керек.',
    'accepted_if'          => 'The must be accepted when :other is :value.',
    'active_url'           => ' жарамды URL мекенжайы емес.',
    'after'                => ' мәні :date күнінен кейінгі күн болуы керек.',
    'after_or_equal'       => ' мәні :date күнінен кейінгі күн немесе тең болуы керек.',
    'alpha'                => ' тек әріптерден тұруы керек.',
    'alpha_dash'           => ' тек әріптерден, сандардан және сызықшалардан тұруы керек.',
    'alpha_num'            => ' тек әріптерден және сандардан тұруы керек.',
    'array'                => ' жиым болуы керек.',
    'before'               => ' мәні :date күнінен дейінгі күн болуы керек.',
    'before_or_equal'      => ' мәні :date күнінен дейінгі күн немесе тең болуы керек.',
    'between'              => [
        'array'   => ' жиымы :min және :max аралығындағы элементтерден тұруы керек.',
        'file'    => ' көлемі :min және :max килобайт аралығында болуы керек.',
        'numeric' => ' мәні :min және :max аралығында болуы керек.',
        'string'  => ' тармағы :min және :max аралығындағы таңбалардан тұруы керек.',
    ],
    'boolean'              => ' жолы шын немесе жалған мән болуы керек.',
    'confirmed'            => ' растауы сәйкес емес.',
    'current_password'     => 'The password is incorrect.',
    'date'                 => ' жарамды күн емес.',
    'date_equals'          => ' мәні :date күнімен тең болуы керек.',
    'date_format'          => ' пішімі :format пішіміне сай емес.',
    'declined'             => 'The must be declined.',
    'declined_if'          => 'The must be declined when :other is :value.',
    'different'            => ' және :other әр түрлі болуы керек.',
    'digits'               => ' мәні :digits сан болуы керек.',
    'digits_between'       => ' мәні :min және :max аралығындағы сан болуы керек.',
    'dimensions'           => ' сурет өлшемі жарамсыз.',
    'distinct'             => ' жолында қосарланған мән бар.',
    'email'                => ' жарамды электрондық пошта мекенжайы болуы керек.',
    'ends_with'            => ' келесі мәндердің біреуінен аяқталуы керек: :values',
    'enum'                 => 'The selected is invalid.',
    'exists'               => ' таңдалған жарамсыз.',
    'file'                 => ' файл болуы тиіс.',
    'filled'               => ' жолы толтырылуы керек.',
    'gt'                   => [
        'array'   => ' мәні :value элементтерден үлкен болуы керек.',
        'file'    => ' файл өлшемі :value килобайттан үлкен болуы керек.',
        'numeric' => ' мәні :value үлкен болуы керек.',
        'string'  => ' мәні :value таңбалардан үлкен болуы керек.',
    ],
    'gte'                  => [
        'array'   => ' мәні :value элементтерден үлкен немесе тең болуы керек.',
        'file'    => ' файл өлшемі :value килобайттан үлкен немесе тең болуы керек.',
        'numeric' => ' мәні :value үлкен немесе тең болуы керек.',
        'string'  => ' мәні :value таңбалардан үлкен немесе тең болуы керек.',
    ],
    'image'                => ' кескін болуы керек.',
    'in'                   => ' таңдалған жарамсыз.',
    'in_array'             => ' жолы :other ішінде жоқ.',
    'integer'              => ' бүтін сан болуы керек.',
    'ip'                   => ' жарамды IP мекенжайы болуы керек.',
    'ipv4'                 => ' жарамды IPv4 мекенжайы болуы керек.',
    'ipv6'                 => ' жарамды IPv6 мекенжайы болуы керек.',
    'json'                 => ' жарамды JSON тармағы болуы керек.',
    'lt'                   => [
        'array'   => ' мәні :value элементтерден кіші болуы керек.',
        'file'    => ' файл өлшемі :value килобайттан кіші болуы керек.',
        'numeric' => ' мәні :value кіші болуы керек.',
        'string'  => ' мәні :value таңбалардан кіші болуы керек.',
    ],
    'lte'                  => [
        'array'   => ' мәні :value элементтерден кіші немесе тең болуы керек.',
        'file'    => ' файл өлшемі :value килобайттан кіші неменсе тең болуы керек.',
        'numeric' => ' мәні :value кіші немесе тең болуы керек.',
        'string'  => ' мәні :value таңбалардан кіші немесе тең болуы керек.',
    ],
    'mac_address'          => 'The must be a valid MAC address.',
    'max'                  => [
        'array'   => ' жиымының құрамы :max элементтен аспауы керек.',
        'file'    => ' мәні :max килобайттан көп болмауы керек.',
        'numeric' => ' мәні :max мәнінен көп болмауы керек.',
        'string'  => ' тармағы :max таңбадан ұзын болмауы керек.',
    ],
    'mimes'                => ' мынадай файл түрі болуы керек: :values.',
    'mimetypes'            => ' мынадай файл түрі болуы керек: :values.',
    'min'                  => [
        'array'   => ' кемінде :min элементтен тұруы керек.',
        'file'    => ' көлемі кемінде :min килобайт болуы керек.',
        'numeric' => ' кемінде :min болуы керек.',
        'string'  => ' кемінде :min таңбадан тұруы керек.',
    ],
    'multiple_of'          => ':attribute :value еселенуі керек',
    'not_in'               => ' таңдалған жарамсыз.',
    'not_regex'            => ' таңдалған форматы жарамсыз.',
    'numeric'              => ' сан болуы керек.',
    'password'             => 'Қате құпиясөз.',
    'present'              => ' болуы керек.',
    'prohibited'           => ':attribute өрісіне тыйым салынады.',
    'prohibited_if'        => ':attribute өрісіне :other :value болған кезде тыйым салынады.',
    'prohibited_unless'    => ':attribute өрісіне тыйым салынады, егер тек :other :values-де болмаса.',
    'prohibits'            => 'The field prohibits :other from being present.',
    'regex'                => ' пішімі жарамсыз.',
    'required'             => ' жолы толтырылуы керек.',
    'required_array_keys'  => 'The field must contain entries for: :values.',
    'required_if'          => ' жолы :other мәні :value болған кезде толтырылуы керек.',
    'required_unless'      => ' жолы :other мәні :values ішінде болмағанда толтырылуы керек.',
    'required_with'        => ' жолы :values болғанда толтырылуы керек.',
    'required_with_all'    => ' жолы :values болғанда толтырылуы керек.',
    'required_without'     => ' жолы :values болмағанда толтырылуы керек.',
    'required_without_all' => ' жолы ешбір :values болмағанда толтырылуы керек.',
    'same'                 => ' және :other сәйкес болуы керек.',
    'size'                 => [
        'array'   => ' жиымы :size элементтен тұруы керек.',
        'file'    => ' көлемі :size килобайт болуы керек.',
        'numeric' => ' көлемі :size болуы керек.',
        'string'  => ' тармағы :size таңбадан тұруы керек.',
    ],
    'starts_with'          => ' келесі мәндердің біреуінен басталуы керек: :values',
    'string'               => ' тармақ болуы керек.',
    'timezone'             => ' жарамды аймақ болуы керек.',
    'unique'               => ' бұрын алынған.',
    'uploaded'             => ' жүктелуі сәтсіз аяқталды.',
    'url'                  => ' пішімі жарамсыз.',
    'uuid'                 => ' мәні жарамды UUID болуы керек.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
];
