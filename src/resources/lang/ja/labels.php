<?php

return [
    'app_name' => 'mDiary',
    'copyright' => '&copy; 2015 Shunichiro Aki.',

    // 固有名詞
    'google' => 'Google',
    'facebook' => 'Facebook',
    'github' => 'GitHub',

    // 入力/表示項目
    'action' => '操作',
    'datetime' => '日時',
    'work_date' => '作業日時',
    'create_date' => '作成日時',
    'email' => 'メールアドレス',
    'title' => 'タイトル',
    'body' => '本文',
    'category' => 'カテゴリ',
    'picture' => '写真',
    'crop' => '作物',
    'work_field' => '圃場',
    'work_diary' => '作業日誌',
    'work_diary_id' => '作業日誌ID',
    'work_record' => '作業記録',
    'remarks' => '備考',
    'detail' => '詳細',
    'archive' => 'アーカイブ',
    'archived' => 'アーカイブ済み',
    'work_content' => '作業内容',
    'pesticide' => '農薬',
    'pesticide_name' => '農薬名',
    'pesticide_usage' => '倍率/使用量',
    'pesticide_summary' => '農薬使用記録',
    'work_complete' => '作業完了',
    'intrarow_spacing' => '株間',
    'cultivar' => '品種',
    'usage_count' => '使用回数',
    'latest_usage_date' => '最終使用日',
    'intrarow_spacing_unit' => 'cm',

    // その他
    'all' => '全て',
    'posted' => 'Posted',
    'created' => 'Created',
    'information' => 'お知らせ',

    // ボタン
    'post' => '投稿',
    'show' => '参照',
    'edit' => '編集',
    'store' => '作成',
    'update' => '更新',
    'destroy' => '削除',
    'search' => '検索',
    'add' => '追加',
    'input_repeat' => '続けて入力',

    // メニュー
    'menu' => [
        'text_diary' => '日記',
        'work' => '作業',
        'aggregate' => '集計',
    ],

    // ルーティング
    'route' => [
        'login' => 'ログイン',
        'logout' => 'ログアウト',
        'home' => 'ホーム',
        'text_diary' => [
            'create' => '日記を書く',
            'edit' => '日記を編集',
            'index' => '日記を見る',
        ],
        'work_diary' => [
            'create' => '作業日誌を作成',
            'edit' => '作業日誌を編集',
            'index' => '作業日誌を見る',
            'show' => '作業日誌詳細',
        ],
        'work_record' => [
            'create' => '作業記録を作成',
            'edit' => '作業記録を編集',
            'index' => '作業記録を見る',
        ],
        'aggregate' => [
            'work_field' => '場所ごとの集計',
            'work_diary' => '作業日誌の集計',
        ],
    ],
];
