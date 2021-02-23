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

    'accepted' => 'ატრიბუტი :attribute უნდა იყოს მიღებული.',
    'active_url' => 'ატრიბუტი :attribute არ არის სწორი URL.',
    'after' => 'ატრიბუტი :attribute უნდა იყოს თარიღი :date-ის შემდეგ.',
    'after_or_equal' => 'ატრიბუტი :attribute უნდა იყოს თარიღი :date-ის შემდეგ ან მისი ტოლი.',
    'alpha' => 'ატრიბუტი :attribute უნდა შეიცავდეს მხოლოდ ასობგერებს.',
    'alpha_dash' => 'ატრიბუტი :attribute უნდა შეიცავდეს მხოლოდ ასობგერებს, ციფრებს, ტირეს და ქვე-ტირეს.',
    'alpha_num' => 'ატრიბუტი :attribute უნდა შეიცავდეს მხოლოდ ასობგერებს და ციფრებს.',
    'array' => 'ატრიბუტი :attribute უნდა იყოს ცვლადი.',
    'before' => 'ატრიბუტი :attribute უნდა იყოს თარიღი :date-ის წინ.',
    'before_or_equal' => 'ატრიბუტი :attribute უნდა იყოს თარიღი :date-ის წინ ან მისი ტოლი.',
    'between' => [
        'numeric' => 'ატრიბუტი :attribute უნდა იყოს :min და :max შორის.',
        'file' => 'ატრიბუტი :attribute უნდა იყოს :min და :max კილობაიტს შორის.',
        'string' => 'ატრიბუტი :attribute უნდა იყოს :min და :max ნიშნებს შორის.',
        'array' => 'ატრიბუტი :attribute უნდა იყოს :min და :max საგანს შორის.',
    ],
    'boolean' => 'ატრიბუტის :attribute ველი უნდა იყოს true ან false.',
    'confirmed' => 'ატრიბუტის :attribute დამოწმება ვერ მოხერხდა.',
    'date' => 'ატრიბუტი :attribute არასწორი თარიღია.',
    'date_equals' => 'ატრიბუტი :attribute უნდა იყოს თარიღი :date-ის ტოლი.',
    'date_format' => 'ატრიბუტი :attribute არ შეესაბამება :format -ის ფორმატს.',
    'different' => 'ატრიბუტი :attribute და :other უნდა იყოს სხვადასხვა.',
    'digits' => 'ატრიბუტი :attribute უნდა იყოს :digits ციფრები.',
    'digits_between' => 'ატრიბუტი :attribute უნდა იყოს :min და :max ციფრებს შორის.',
    'dimensions' => 'სურათის ატრიბუტს :attribute გააჩნია არასწორი ზომები.',
    'distinct' => 'ატრიბუტის :attribute ველს გააჩნია დუბლირებული მნიშვნელობა.',
    'email' => 'ატრიბუტი :attribute უნდა იყოს მართებული ელ-ფოსტის მისამართი.',
    'ends_with' => 'ატრიბუტი :attribute უნდა დამთავრდეს: :values-ით',
    'exists' => 'არჩეული ატრიბუტი :attribute არ არის სწორი.',
    'file' => 'ატრიბუტი :attribute უნდა იყოს ფაილი.',
    'filled' => 'ატრიბუტის :attribute ველს უნდა გააჩნდეს მნიშვნელობა.',
    'gt' => [
        'numeric' => 'ატრიბუტის :attribute მნიშვნელობა უნდა იყოს უფრო მეტი, ვიდრე :value.',
        'file' => 'ატრიბუტის :attribute მნიშვნელობა უნდა იყოს უფრო მეტი, ვიდრე :value კილობაიტი.',
        'string' => 'ატრიბუტი :attribute უნდა იყოს უფრო მეტი, ვიდრე :value სიმბოლო.',
        'array' => 'ატრიბუტი :attribute უნდა შეიცავდეს უფრო მეტ საგანს, ვიდრე :value.',
    ],
    'gte' => [
        'numeric' => 'ატრიბუტი :attribute უნდა იყოს უფრო მეტი ან ტოლი, ვიდრე :value.',
        'file' => 'ატრიბუტი :attribute უნდა იყოს უფრო მეტი ან ტოლი, ვიდრე :value კილობაიტი.',
        'string' => 'ატრიბუტი :attribute უნდა იყოს უფრო მეტი ან ტოლი, ვიდრე :value სიმბოლო.',
        'array' => 'ატრიბუტი :attribute უნდა შეიცავდეს :value საგანს ან უფრო მეტს.',
    ],
    'image' => 'ატრიბუტი :attribute უნდა იყოს სურათი.',
    'in' => 'არჩეული ატრიბუტი :attribute არასწორია.',
    'in_array' => 'ატრიბუტის :attribute ველი :other-ში არ არსებობს.',
    'integer' => 'ატრიბუტი :attribute უნდა იყოს მთელი რიცხვი.',
    'ip' => 'ატრიბუტი :attribute უნდა იყოს მართებული IP მისამართი.',
    'ipv4' => 'ატრიბუტი :attribute უნდა იყოს მართებული IPv4 მისამართი.',
    'ipv6' => 'ატრიბუტი :attribute უნდა იყოს მართებული IPv6 მისამართი.',
    'json' => 'ატრიბუტი :attribute უნდა იყოს მართებული JSON სტროფი.',
    'lt' => [
        'numeric' => 'ატრიბუტი :attribute უნდა იყოს :value ნაკლები.',
        'file' => 'ატრიბუტი :attribute უნდა იყოს :value კილობაიტზე ნაკლები.',
        'string' => 'ატრიბუტი :attribute უნდა იყოს :value სიმბოლოზე ნაკლები.',
        'array' => 'ატრიბუტი :attribute უნდა შეიცავდეს :value საგანზე ნაკლებს.',
    ],
    'lte' => [
        'numeric' => 'ატრიბუტი :attribute უნდა იყოს :value ნაკლები ან ტოლი.',
        'file' => 'ატრიბუტი :attribute უნდა იყოს :value კილობაიტზე ნაკლები ან ტოლი.',
        'string' => 'ატრიბუტი :attribute უნდა შეიცავდეს :value ნაკლებ ან ტოლი რაოდენობის სიმბოლოს.',
        'array' => 'ატრიბუტს :attribute არ უნდა გააჩნდეს უფრო მეტი საგანი, ვიდრე :value.',
    ],
    'max' => [
        'numeric' => 'ატრიბუტი :attribute არ უნდა იყოს :max მეტი.',
        'file' => 'ატრიბუტი :attribute არ უნდა იყოს :max კილობაიტზე მეტი.',
        'string' => 'ატრიბუტი :attribute არ უნდა იყოს :max სიმბოლოზე მეტი.',
        'array' => 'ატრიბუტი :attribute არ უნდა შეიცავდეს:max საგანზე მეტს.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'attributes' => [],

];
