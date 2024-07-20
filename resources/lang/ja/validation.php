<?php

return [
    'accepted' => ':attribute を承認してください。',
    'active_url' => ':attribute は、有効なURLではありません。',
    'after' => ':attribute には、:date 以降の日付を指定してください。',
    'alpha' => ':attribute には、アルファベッドのみ使用できます。',
    'alpha_dash' => ":attribute には、アルファベッドとダッシュ(-)及び下線(_)が使用できます。",
    'alpha_num' => ':attribute には、アルファベッドと数字が使用できます。',
    'array' => ':attribute には、配列を指定してください。',
    'before' => ':attribute には、:date 以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attribute は、:min から :max の間で指定してください。',
        'file' => ':attribute は、:min kBから :max kBの間で指定してください。',
        'string' => ':attribute は、:min 文字から :max 文字の間で指定してください。',
        'array' => ':attribute は、:min 個から :max 個の間で指定してください。',
    ],
    'exists' => '選択された :attribute は無効です。',
    'min' => [
        'string' => ':attribute は、最低 :min 文字でなければなりません。',
    ],
    'confirmed' => ':attribute の確認が一致しません。',
    'regex' => ':attribute の形式が無効です。',
    // 他のバリデーションメッセージも追加

    'attributes' => [
        'custom_id' => '職員ID',
        'password' => 'パスワード',
    ],

    'custom' => [
        'custom_id' => [
            'exists' => '入力された職員IDは無効です。施設管理者にお問い合わせください。',
        ],
        'password' => [
            'min' => 'パスワードは、最低 :min 文字でなければなりません。',
            'confirmed' => 'パスワードが一致しません。',
            'regex' => 'パスワードはアルファベットの大文字小文字・数字を含む8文字以上にしてください。',
        ],
    ],
];
