<?php

return [
    'input' => ':nameを入力してください。',
    'signInWith' => ':nameアカウントでログイン',
    'complete' => ':nameが完了しました！',
    'othersUpdate' => 'ほかの人が更新を行った可能性があります。再度入力して下さい。',
    'workDiaryWithArchive' => 'アーカイブ済みの作業日誌を含む',
    'updateArchive' => 'この日誌をアーカイブする',
    'addTo' => ':nameを追加',
    'deleteTo' => ':nameを削除',

    'confirm' => [
        'delete' => '本当に削除してもよろしいですか？',
        'workDiaryArchive' => '作業日誌をアーカイブすると、編集することができなくなります。' . "\n" .
            '本当にアーカイブしてもよろしいですか？',
    ],

    'help' => [
        'textDiaryEdit' => [
            'picture' => '既にアップロードしたファイルを削除する場合は、下記の画像をクリックして下さい。',
        ],
        'workDiaryCreate' => [
            'field' => '複数圃場の作業日誌を一括で作成することができます。' . "\n" .
                '選択できない圃場は、以前の作業日誌をアーカイブした後に選択できます。',
        ],
        'workDiaryIndex' => [
            'field' => '未選択の場合、全ての圃場を検索します。',
        ],
        'workRecordCreate' => [
            'workDiary' => 'アーカイブしていない作業日誌のみ選択することができます。',
            'workComplete' => 'チェックした場合、集計画面の終了日に日付が入ります。',
        ],
    ],
];
