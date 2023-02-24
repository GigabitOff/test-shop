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
    'accepted'             => 'Το πεδίο πρέπει να γίνει αποδεκτό.',
    'accepted_if'          => 'The must be accepted when :other is :value.',
    'active_url'           => 'Το πεδίο δεν είναι αποδεκτή διεύθυνση URL.',
    'after'                => 'Το πεδίο πρέπει να είναι μία ημερομηνία μετά από :date.',
    'after_or_equal'       => 'Το πεδίο πρέπει να είναι μία ημερομηνία ίδια ή μετά από :date.',
    'alpha'                => 'Το πεδίο μπορεί να περιέχει μόνο γράμματα.',
    'alpha_dash'           => 'Το πεδίο μπορεί να περιέχει μόνο γράμματα, αριθμούς, και παύλες.',
    'alpha_num'            => 'Το πεδίο μπορεί να περιέχει μόνο γράμματα και αριθμούς.',
    'array'                => 'Το πεδίο πρέπει να είναι ένας πίνακας.',
    'before'               => 'Το πεδίο πρέπει να είναι μία ημερομηνία πριν από :date.',
    'before_or_equal'      => 'Το πεδίο πρέπει να είναι μία ημερομηνία ίδια ή πριν από :date.',
    'between'              => [
        'array'   => 'Το πεδίο πρέπει να έχει μεταξύ :min - :max αντικείμενα.',
        'file'    => 'Το πεδίο πρέπει να είναι μεταξύ :min - :max kilobytes.',
        'numeric' => 'Το πεδίο πρέπει να είναι μεταξύ :min - :max.',
        'string'  => 'Το πεδίο πρέπει να είναι μεταξύ :min - :max χαρακτήρες.',
    ],
    'boolean'              => 'Το πεδίο πρέπει να είναι true ή false.',
    'confirmed'            => 'Η επιβεβαίωση του δεν ταιριάζει.',
    'current_password'     => 'The password is incorrect.',
    'date'                 => 'Το πεδίο δεν είναι έγκυρη ημερομηνία.',
    'date_equals'          => 'Το στοιχείο πρέπει να είναι μια ημερομηνία, όπως η εξής :date.',
    'date_format'          => 'Το πεδίο δεν είναι της μορφής :format.',
    'declined'             => 'The must be declined.',
    'declined_if'          => 'The must be declined when :other is :value.',
    'different'            => 'Το πεδίο και :other πρέπει να είναι διαφορετικά.',
    'digits'               => 'Το πεδίο πρέπει να είναι :digits ψηφία.',
    'digits_between'       => 'Το πεδίο πρέπει να είναι μεταξύ :min και :max ψηφία.',
    'dimensions'           => 'Το πεδίο περιέχει μη έγκυρες διαστάσεις εικόνας.',
    'distinct'             => 'Το πεδίο περιέχει δύο φορές την ίδια τιμή.',
    'email'                => 'Το πεδίο πρέπει να είναι μία έγκυρη διεύθυνση email.',
    'ends_with'            => 'Το πεδίο πρέπει να τελειώνει με ένα από τα παρακάτω: :values.',
    'enum'                 => 'The selected is invalid.',
    'exists'               => 'Το επιλεγμένο δεν είναι έγκυρο.',
    'file'                 => 'Το πεδίο πρέπει να είναι αρχείο.',
    'filled'               => 'To πεδίο είναι απαραίτητο.',
    'gt'                   => [
        'array'   => 'To πεδίο πρέπει να έχει περισσότερα από :value αντικείμενα.',
        'file'    => 'To πεδίο πρέπει να είναι μεγαλύτερο από :value kilobytes.',
        'numeric' => 'To πεδίο πρέπει να είναι μεγαλύτερο από :value.',
        'string'  => 'To πεδίο πρέπει να είναι μεγαλύτερο από :value χαρακτήρες.',
    ],
    'gte'                  => [
        'array'   => 'To πεδίο πρέπει να έχει :value αντικείμενα ή περισσότερα.',
        'file'    => 'To πεδίο πρέπει να είναι μεγαλύτερο ή ίσο από :value kilobytes.',
        'numeric' => 'To πεδίο πρέπει να είναι μεγαλύτερο ή ίσο από :value.',
        'string'  => 'To πεδίο πρέπει να είναι μεγαλύτερο ή ίσο από :value χαρακτήρες.',
    ],
    'image'                => 'Το πεδίο πρέπει να είναι εικόνα.',
    'in'                   => 'Το επιλεγμένο δεν είναι έγκυρο.',
    'in_array'             => 'Το πεδίο δεν υπάρχει σε :other.',
    'integer'              => 'Το πεδίο πρέπει να είναι ακέραιος.',
    'ip'                   => 'Το πεδίο πρέπει να είναι μία έγκυρη διεύθυνση IP.',
    'ipv4'                 => 'Το πεδίο πρέπει να είναι μία έγκυρη διεύθυνση IPv4.',
    'ipv6'                 => 'Το πεδίο πρέπει να είναι μία έγκυρη διεύθυνση IPv6.',
    'json'                 => 'Το πεδίο πρέπει να είναι μία έγκυρη συμβολοσειρά JSON.',
    'lt'                   => [
        'array'   => 'To πεδίο πρέπει να έχει λιγότερα από :value αντικείμενα.',
        'file'    => 'To πεδίο πρέπει να είναι μικρότερo από :value kilobytes.',
        'numeric' => 'To πεδίο πρέπει να είναι μικρότερo από :value.',
        'string'  => 'To πεδίο πρέπει να είναι μικρότερo από :value χαρακτήρες.',
    ],
    'lte'                  => [
        'array'   => 'To πεδίο δεν πρέπει να υπερβαίνει τα :value αντικείμενα.',
        'file'    => 'To πεδίο πρέπει να είναι μικρότερo ή ίσο από  :value kilobytes.',
        'numeric' => 'To πεδίο πρέπει να είναι μικρότερo ή ίσο από :value.',
        'string'  => 'To πεδίο πρέπει να είναι μικρότερo ή ίσο από  :value χαρακτήρες.',
    ],
    'mac_address'          => 'The must be a valid MAC address.',
    'max'                  => [
        'array'   => 'Το πεδίο δεν μπορεί να έχει περισσότερα από :max αντικείμενα.',
        'file'    => 'Το πεδίο δεν μπορεί να είναι μεγαλύτερό :max kilobytes.',
        'numeric' => 'Το πεδίο δεν μπορεί να είναι μεγαλύτερο από :max.',
        'string'  => 'Το πεδίο δεν μπορεί να έχει περισσότερους από :max χαρακτήρες.',
    ],
    'mimes'                => 'Το πεδίο πρέπει να είναι αρχείο τύπου: :values.',
    'mimetypes'            => 'Το πεδίο πρέπει να είναι αρχείο τύπου: :values.',
    'min'                  => [
        'array'   => 'Το πεδίο πρέπει να έχει τουλάχιστον :min αντικείμενα.',
        'file'    => 'Το πεδίο πρέπει να είναι τουλάχιστον :min kilobytes.',
        'numeric' => 'Το πεδίο πρέπει να είναι τουλάχιστον :min.',
        'string'  => 'Το πεδίο πρέπει να έχει τουλάχιστον :min χαρακτήρες.',
    ],
    'multiple_of'          => 'Το πρέπει να είναι πολλαπλάσιο του :value',
    'not_in'               => 'Το επιλεγμένο δεν είναι αποδεκτό.',
    'not_regex'            => 'Η μορφή του πεδίου δεν είναι αποδεκτή.',
    'numeric'              => 'Το πεδίο πρέπει να είναι αριθμός.',
    'password'             => 'Ο κωδικός είναι λανθασμένος.',
    'present'              => 'Το πεδίο πρέπει να υπάρχει.',
    'prohibited'           => 'Το πεδίο απαγορεύεται.',
    'prohibited_if'        => 'Το πεδίο απαγορεύεται όταν το :other είναι :value.',
    'prohibited_unless'    => 'Το πεδίο απαγορεύεται εκτός αν το :other βρίσκεται στο :values.',
    'prohibits'            => 'The field prohibits :other from being present.',
    'regex'                => 'Η μορφή του πεδίου δεν είναι αποδεκτή.',
    'required'             => 'Το πεδίο είναι απαραίτητο.',
    'required_array_keys'  => 'The field must contain entries for: :values.',
    'required_if'          => 'Το πεδίο είναι απαραίτητο όταν το πεδίο :other είναι :value.',
    'required_unless'      => 'Το πεδίο είναι απαραίτητο εκτός αν το πεδίο :other εμπεριέχει :values.',
    'required_with'        => 'Το πεδίο είναι απαραίτητο όταν υπάρχει :values.',
    'required_with_all'    => 'Το πεδίο είναι απαραίτητο όταν υπάρχουν :values.',
    'required_without'     => 'Το πεδίο είναι απαραίτητο όταν δεν υπάρχει :values.',
    'required_without_all' => 'Το πεδίο είναι απαραίτητο όταν δεν υπάρχει κανένα από :values.',
    'same'                 => 'Τα πεδία και :other πρέπει να είναι ίδια.',
    'size'                 => [
        'array'   => 'Το πεδίο πρέπει να περιέχει :size αντικείμενα.',
        'file'    => 'Το πεδίο πρέπει να είναι :size kilobytes.',
        'numeric' => 'Το πεδίο πρέπει να είναι :size.',
        'string'  => 'Το πεδίο πρέπει να είναι :size χαρακτήρες.',
    ],
    'starts_with'          => 'Το στοιχείο πρέπει να ξεκινά με ένα από τα παρακάτω: :values',
    'string'               => 'Το πεδίο πρέπει να είναι αλφαριθμητικό.',
    'timezone'             => 'Το πεδίο πρέπει να είναι μία έγκυρη ζώνη ώρας.',
    'unique'               => 'Το πεδίο έχει ήδη εκχωρηθεί.',
    'uploaded'             => 'Η μεταφόρτωση του πεδίου απέτυχε.',
    'url'                  => 'Το πεδίο δεν είναι έγκυρη διεύθυνση URL.',
    'uuid'                 => 'Το πεδίο πρέπει να είναι έγκυρο UUID.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
];
