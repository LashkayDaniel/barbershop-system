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

    'accepted' => 'Поле :attribute має бути прийняте.',
    'accepted_if' => 'Поле :attribute має бути прийняте, коли :other дорівнює :value.',
    'active_url' => 'Поле :attribute має бути дійсним URL.',
    'after' => 'Поле :attribute має бути датою після :date.',
    'after_or_equal' => 'Поле :attribute має бути датою після або дорівнювати :date.',
    'alpha' => 'Поле :attribute може містити лише літери.',
    'alpha_dash' => 'Поле :attribute може містити лише літери, цифри, дефіси та підкреслення.',
    'alpha_num' => 'Поле :attribute може містити лише літери та цифри.',
    'array' => 'Поле :attribute має бути масивом.',
    'ascii' => 'Поле :attribute може містити лише однобайтові буквено-цифрові символи та символи.',
    'before' => 'Поле :attribute має бути датою до :date.',
    'before_or_equal' => 'Поле :attribute має бути датою до або дорівнювати :date.',
    'between' => [
        'array' => 'Поле :attribute повинно містити від :min до :max елементів.',
        'file' => 'Поле :attribute повинно бути між :min та :max кілобайт.',
        'numeric' => 'Поле :attribute повинно бути між :min та :max.',
        'string' => 'Поле :attribute повинно бути між :min та :max символами.',
    ],
    'boolean' => 'Поле :attribute має бути true або false.',
    'can' => 'Поле :attribute містить неприпустиме значення.',
    'confirmed' => 'Підтвердження поля :attribute не співпадає.',
    'current_password' => 'Неправильний пароль.',
    'date' => 'Поле :attribute має бути дійсною датою.',
    'date_equals' => 'Поле :attribute має бути датою, рівною :date.',
    'date_format' => 'Поле :attribute не відповідає формату :format.',
    'decimal' => 'Поле :attribute має бути десятковим числом з :decimal десятковими місцями.',
    'declined' => 'Поле :attribute має бути відхилене.',
    'declined_if' => 'Поле :attribute має бути відхилене, коли :other дорівнює :value.',
    'different' => 'Поля :attribute та :other повинні бути різними.',
    'digits' => 'Поле :attribute повинно бути довжиною :digits цифр.',
    'digits_between' => 'Поле :attribute повинно бути між :min та :max цифрами.',
    'dimensions' => 'Поле :attribute має недійсні розміри зображення.',
    'distinct' => 'Поле :attribute містить дубльоване значення.',
    'doesnt_end_with' => 'Поле :attribute повинне закінчуватися одним із наступних значень: :values.',
    'doesnt_start_with' => 'Поле :attribute повинно починатися одним із наступних значень: :values.',
    'email' => 'Поле :attribute повинно бути дійсною адресою електронної пошти.',
    'ends_with' => 'Поле :attribute повинне закінчуватися одним із наступних значень: :values.',
    'enum' => 'Вибране значення для :attribute недійсне.',
    'exists' => 'Вибране для :attribute значення недійсне.',
    'extensions' => 'Поле :attribute повинно мати одне з наступних розширень: :values.',
    'file' => 'Поле :attribute має бути файлом.',
    'filled' => 'Поле :attribute повинно містити значення.',
    'greater_than' => [
        'array' => 'Поле :attribute повинне містити більше :value елементів.',
        'file' => 'Поле :attribute повинне бути більшим за :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більшим за :value.',
        'string' => 'Поле :attribute повинно бути більшим за :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute повинно містити :value елементів або більше.',
        'file' => 'Поле :attribute повинно бути більше або дорівнювати :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше або дорівнювати :value.',
        'string' => 'Поле :attribute повинно бути більше або дорівнювати :value символів.',
    ],
    'hex_color' => 'Поле :attribute повинне бути дійсним шістнадцятковим кольором.',
    'image' => 'Поле :attribute повинне бути зображенням.',
    'in' => 'Вибране для :attribute значення недійсне.',
    'in_array' => 'Поле :attribute не існує в :other.',
    'integer' => 'Поле :attribute повинно бути цілим числом.',
    'ip' => 'Поле :attribute повинне бути дійсною IP-адресою.',
    'ipv4' => 'Поле :attribute повинне бути дійсною адресою IPv4.',
    'ipv6' => 'Поле :attribute повинне бути дійсною адресою IPv6.',
    'json' => 'Поле :attribute повинно бути дійсним JSON рядком.',
    'lowercase' => 'Поле :attribute повинне бути в нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute повинно містити менше :value елементів.',
        'file' => 'Поле :attribute повинне бути менше, ніж :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше, ніж :value.',
        'string' => 'Поле :attribute повинно бути менше, ніж :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute повинно містити :value елементів або менше.',
        'file' => 'Поле :attribute повинно бути меншим або дорівнювати :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути меншим або дорівнювати :value.',
        'string' => 'Поле :attribute повинно бути меншим або дорівнювати :value символів.',
    ],
    'mac_address' => 'Поле :attribute повинно бути дійсною MAC адресою.',

    'max' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :max елементів.',
        'file' => 'Поле :attribute не повинно бути більше ніж :max кілобайт.',
        'numeric' => 'Поле :attribute не повинно бути більше ніж :max.',
        'string' => 'Поле :attribute не повинно бути більше ніж :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше ніж :max цифр.',
    'mimes' => 'Поле :attribute має бути файлом типу: :values.',
    'mimetypes' => 'Поле :attribute має бути файлом типу: :values.',
    'min' => [
        'array' => 'Поле :attribute має містити принаймні :min елементів.',
        'file' => 'Поле :attribute має містити принаймні :min кілобайт.',
        'numeric' => 'Поле :attribute має містити принаймні :min.',
        'string' => 'Поле :attribute має містити принаймні :min символів.',
    ],
    'min_digits' => 'Поле :attribute повинне містити принаймні :min цифр.',
    'missing' => 'Поле :attribute повинно бути відсутнім.',
    'missing_if' => 'Поле :attribute повинне бути відсутнім, коли :other є :value.',
    'missing_unless' => 'Поле :attribute повинне бути відсутнім, якщо :other не є :value.',
    'missing_with' => 'Поле :attribute повинне бути відсутнім, коли присутній :values.',
    'missing_with_all' => 'Поле :attribute повинне бути відсутнім, коли присутні всі :values.',
    'multiple_of' => 'Поле :attribute повинне бути кратним :value.',
    'not_in' => 'Вибране для :attribute значення недійсне.',
    'not_regex' => 'Формат поля :attribute недійсний.',
    'numeric' => 'Поле :attribute повинне бути числом.',
    'password' => [
        'letters' => 'Поле :attribute повинне містити принаймні одну літеру.',
        'mixed' => 'Поле :attribute повинне містити принаймні одну велику літеру і одну маленьку.',
        'numbers' => 'Поле :attribute повинне містити принаймні одне число.',
        'symbols' => 'Поле :attribute повинне містити принаймні один символ.',
        'uncompromised' => 'Вказане :attribute з\'являлось в витоку даних. Будь ласка, виберіть інше :attribute.',
    ],
    'present' => 'Поле :attribute повинне бути присутнім.',
    'present_if' => 'Поле :attribute повинне бути присутнім, коли :other є :value.',
    'present_unless' => 'Поле :attribute повинне бути присутнім, якщо :other не є :value.',
    'present_with' => 'Поле :attribute повинне бути присутнім, коли присутній :values.',
    'present_with_all' => 'Поле :attribute повинне бути присутнім, коли присутні всі :values.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, коли :other є :value.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не є :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Формат поля :attribute недійсний.',
    'required' => 'Поле :attribute є обов\'язковим . ',
    'required_array_keys' => 'Поле :attribute повинно містити записи для: :values . ',
    'required_if' => 'Поле :attribute є обов\'язковим, коли :other є :value.',
    'required_if_accepted' => 'Поле :attribute є обов\'язковим, коли :other прийнято . ',
    'required_unless' => 'Поле :attribute є обов\'язковим, якщо :other не є :values.',
    'required_with' => 'Поле :attribute є обов\'язковим, коли присутній :values . ',
    'required_with_all' => 'Поле :attribute є обов\'язковим, коли присутні всі :values.',
    'required_without' => 'Поле :attribute є обов\'язковим, коли відсутній :values . ',
    'required_without_all' => 'Поле :attribute є обов\'язковим, коли відсутні всі :values.',
    'same' => 'Поле :attribute повинне збігатися з :other.',
    'size' => [
        'array' => 'Поле :attribute повинне містити :size елементів.',
        'file' => 'Поле :attribute повинне бути :size кілобайт.',
        'numeric' => 'Поле :attribute повинне бути :size.',
        'string' => 'Поле :attribute повинне бути :size символів.',
    ],
    'starts_with' => 'Поле :attribute повинне починатися з одного з наступних значень: :values.',
    'string' => 'Поле :attribute повинне бути рядком.',
    'timezone' => 'Поле :attribute повинне бути дійсним часовим поясом.',
    'unique' => 'Значення :attribute вже зайняте.',
    'uploaded' => 'Поле :attribute не вдалося завантажити.',
    'uppercase' => 'Поле :attribute повинне бути великими літерами.',
    'url' => 'Поле :attribute повинне бути дійсною URL-адресою.',
    'ulid' => 'Поле :attribute повинне бути дійсним ULID.',
    'uuid' => 'Поле :attribute повинне бути дійсним UUID.',

];
