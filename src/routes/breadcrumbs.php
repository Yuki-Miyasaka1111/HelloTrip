<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// プロジェクト管理
Breadcrumbs::for('project.index', function ($trail) {
    $trail->push('プロジェクト管理', route('project.index'));
});

// プロジェクト管理 > 施設
Breadcrumbs::for('project.hotel.index', function ($trail) {
    $trail->parent('project.index');
    $trail->push('施設', route('project.hotel.index'));
});

// プロジェクト管理 > 施設 > コンセプト編集
Breadcrumbs::for('project.hotel.editConcept', function ($trail, $id) {
    $trail->parent('project.hotel.index');
    $trail->push('コンセプト', route('project.hotel.editConcept', $id));
});

// プロジェクト管理 > キャンペーン
Breadcrumbs::for('project.campaign.index', function ($trail) {
    $trail->parent('project.index');
    $trail->push('キャンペーン', route('project.campaign.index'));
});


