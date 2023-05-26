<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// プロジェクト管理
Breadcrumbs::for('project.index', function ($trail) {
    $trail->push('プロジェクト管理', route('project.index'));
});

// プロジェクト管理 > 施設
Breadcrumbs::for('project.hotel.index', function ($trail) {
    $trail->parent('project.index');
    $trail->push('施設情報', route('project.hotel.index'));
});

// プロジェクト管理 > 施設 > 基本情報
Breadcrumbs::for('project.hotel.editBasicInformation', function ($trail, $id) {
    $trail->parent('project.hotel.index');
    $trail->push('基本情報', route('project.hotel.editBasicInformation', $id));
});

// プロジェクト管理 > 施設 > コンセプト編集
Breadcrumbs::for('project.hotel.editConcept', function ($trail, $id) {
    $trail->parent('project.hotel.index');
    $trail->push('コンセプト', route('project.hotel.editConcept', $id));
});

// プロジェクト管理 > 施設 > 設備
Breadcrumbs::for('project.hotel.editFacilities', function ($trail, $id) {
    $trail->parent('project.hotel.index');
    $trail->push('設備', route('project.hotel.editFacilities', $id));
});

// プロジェクト管理 > キャンペーン情報
Breadcrumbs::for('project.campaign.index', function ($trail) {
    $trail->parent('project.index');
    $trail->push('キャンペーン情報', route('project.campaign.index'));
});

// プロジェクト管理 > キャンペーン > キャンペーン新規登録
Breadcrumbs::for('project.campaign.createCampaign', function ($trail, $id) {
    $trail->parent('project.campaign.index');
    $trail->push('キャンペーン新規登録', route('project.campaign.createCampaign', $id));
});

// プロジェクト管理 > キャンペーン > キャンペーン管理
Breadcrumbs::for('project.campaign.manageCampaign', function ($trail, $id) {
    $trail->parent('project.campaign.index');
    $trail->push('キャンペーン管理', route('project.campaign.manageCampaign', $id));
});