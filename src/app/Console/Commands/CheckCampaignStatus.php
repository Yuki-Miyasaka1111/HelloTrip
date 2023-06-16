<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Campaign;

class CheckCampaignStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:campaign_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update campaign status based on publication dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 現在の日時を取得
        $now = Carbon::now();

        // 公開状態のキャンペーンを取得
        $campaigns = Campaign::where('publish_status', 1)->get();

        foreach ($campaigns as $campaign) {
            // 公開終了日が設定されていて、かつ現在日時が公開終了日を超えている場合
            if ($campaign->end_publication_date && $now->greaterThanOrEqualTo($campaign->end_publication_date)) {
                $campaign->publish_status = 0; // 非公開に更新
                $campaign->save();
            }
        }

        // 非公開状態のキャンペーンを取得
        $campaigns = Campaign::where('publish_status', 0)->get();

        foreach ($campaigns as $campaign) {
            // 公開日が設定されていて、かつ現在日時が公開日を超えている場合
            if ($campaign->publication_date && $now->greaterThanOrEqualTo($campaign->publication_date)) {
                $campaign->publish_status = 1; // 公開に更新
                $campaign->save();
            }
        }
    }
}
