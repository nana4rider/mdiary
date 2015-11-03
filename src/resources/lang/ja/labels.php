<?php

return [
    'appName' => 'mDiary',

    // 固有名詞
    'google' => 'Google',
    'facebook' => 'Facebook',
    'github' => 'GitHub',

    // 入力/表示項目
    'action' => '操作',
    'datetime' => '日時',
    'email' => 'メールアドレス',
    'title' => 'タイトル',
    'body' => '本文',
    'category' => 'カテゴリ',
    'picture' => '写真',
    'crop' => '作物',
    'workField' => '圃場',
    'workDiary' => '作業日誌',
    'workRecord' => '作業記録',
    'remarks' => '備考',
    'archive' => 'アーカイブ',
    'archived' => 'アーカイブ済み',
    'create_date' => '作成日時',
    'work' => '作業内容',
    'pesticide' => '農薬',
    'pesticideUsage' => '倍率/使用量',
    'workComplete' => '作業完了',

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
    'inputRepeat' => '続けて入力',

    // メニュー
    'menu' => [
        'textDiary' => '日記',
        'work' => '作業',
        'aggregate' => '集計',
    ],

    // ルーティング
    'route' => [
        'login' => 'ログイン',
        'logout' => 'ログアウト',
        'home' => 'ホーム',
        'textDiary' => [
            'create' => '日記を書く',
            'edit' => '日記を編集',
            'index' => '日記を見る',
        ],
        'workDiary' => [
            'create' => '作業日誌を作成',
            'edit' => '作業日誌を編集',
            'index' => '作業日誌を見る',
            'show' => '作業日誌詳細',
        ],
        'workRecord' => [
            'create' => '作業記録を作成',
            'edit' => '作業記録を編集',
            'index' => '作業記録を見る',
        ],
        'aggregate' => [
            'workField' => '場所ごとの集計',
            'workDiary' => '作業日誌の集計',
        ],
    ],
];
