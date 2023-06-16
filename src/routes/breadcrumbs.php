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
Breadcrumbs::for('project.hotel.editBasicInformation', function ($trail, $hotel_id) {
    $trail->parent('project.hotel.index', $hotel_id);
    $trail->push('基本情報', route('project.hotel.editBasicInformation', ['hotel_id' => $hotel_id]));
});

// プロジェクト管理 > 施設 > コンセプト編集
Breadcrumbs::for('project.hotel.editConcept', function ($trail, $hotel_id) {
    $trail->parent('project.hotel.index', $hotel_id);
    $trail->push('コンセプト', route('project.hotel.editConcept', ['hotel_id' => $hotel_id]));
});

// プロジェクト管理 > 施設 > 設備
Breadcrumbs::for('project.hotel.editFacilities', function ($trail, $hotel_id) {
    $trail->parent('project.hotel.index', $hotel_id);
    $trail->push('設備', route('project.hotel.editFacilities', ['hotel_id' => $hotel_id]));
});

// プロジェクト管理 > キャンペーン > キャンペーン新規登録
Breadcrumbs::for('project.campaign.createCampaign', function ($trail, $hotel_id) {
    $trail->parent('project.hotel.index', $hotel_id);
    $trail->push('キャンペーン新規登録', route('project.campaign.createCampaign', ['hotel_id' => $hotel_id]));
});

// プロジェクト管理 > キャンペーン > キャンペーン管理
Breadcrumbs::for('project.campaign.manageCampaign', function ($trail, $hotel_id) {
    $trail->parent('project.hotel.index', $hotel_id);
    $trail->push('キャンペーン管理', route('project.campaign.manageCampaign', ['hotel_id' => $hotel_id]));
});

// プロジェクト管理 > キャンペーン > キャンペーン管理
Breadcrumbs::for('project.campaign.editCampaign', function ($trail, $hotel_id, $campaign_id) {
    $trail->parent('project.campaign.manageCampaign', $hotel_id, $campaign_id);
    $trail->push('キャンペーン編集', route('project.campaign.editCampaign', ['hotel_id' => $hotel_id, 'campaign_id'=> $campaign_id]));
});