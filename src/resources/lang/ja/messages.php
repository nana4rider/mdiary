<?php

return [
    'input' => ':nameを入力してください。',
    'sign_in_with' => ':nameアカウントでログイン',
    'complete' => ':nameが完了しました！',
    'others_update' => 'ほかの人が更新を行った可能性があります。再度入力して下さい。',
    'work_diary_with_archive' => 'アーカイブ済みの作業日誌を含む',
    'update_archive' => 'この日誌をアーカイブする',
    'add_to' => ':nameを追加',
    'delete_to' => ':nameを削除',
    'max_times' => '最大:value回',
    'unselected_search_all' => '未選択の場合、全ての:nameを検索します。',

    'confirm' => [
        'delete' => '本当に削除してもよろしいですか？',
        'work_diary_archive' => '作業日誌をアーカイブすると、編集することができなくなります。' . "\n" .
            '本当にアーカイブしてもよろしいですか？',
    ],

    'help' => [
        'text_diary_edit' => [
            'picture' => '既にアップロードしたファイルを削除する場合は、下記の画像をクリックして下さい。',
        ],
        'work_diary_create' => [
            'field' => '複数圃場の作業日誌を一括で作成することができます。' . "\n" .
                '選択できない圃場は、以前の作業日誌をアーカイブした後に選択できます。',
        ],
        'work_diary_index' => [
            'field' => '未選択の場合、全ての圃場を検索します。',
        ],
        'work_record_create' => [
            'work_diary' => 'アーカイブしていない作業日誌のみ選択することができます。',
            'work_complete' => 'チェックした場合、集計画面の終了日に日付が入ります。',
        ],
        'work_record_index' => [
            'field' => '未選択の場合、全ての圃場を検索します。',
        ],
    ],
];
