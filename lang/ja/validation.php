<?php

return [
    'required' => ':attributeを入力してください。',
    'confirmed' => ':attributeの確認が一致しません。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'email' => ':attributeは有効なメールアドレスの形式で入力してください。',
    'unique' => 'この:attributeは既に使用されています。',
    'string' => ':attributeは文字列で入力してください。',

    'attributes' => [
        'current_password' => '現在のパスワード',
        'password' => '新しいパスワード',
        'password_confirmation' => '新しいパスワード（確認）',
        'name' => 'お名前',
        'email' => 'メールアドレス',
    ],
];
