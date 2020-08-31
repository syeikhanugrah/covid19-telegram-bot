<?php

namespace App\Command;

use App\Api\Covid19Api;
use App\Util\NumberUtil;
use BotMan\BotMan\BotMan;
use Spatie\Emoji\Emoji;

class Covid19Command
{
    const GET_SUMMARY_KEYWORD = '/info';

    private $covid19Api;

    public function __construct()
    {
        $this->covid19Api = new Covid19Api();
    }

    public function handleSummary(BotMan $bot)
    {
        $summary = $this->covid19Api->getConfirmedCaseToday();
        $message = $this->formatSummaryMessage($summary);

        $bot->reply($message);
    }

    private function formatSummaryMessage($data)
    {
        $updateTotalPositive = NumberUtil::shortNumber($data['update']['total']['jumlah_positif']);
        $updateTotalRecovered = NumberUtil::shortNumber($data['update']['total']['jumlah_sembuh']);
        $updateTotalDeaths = NumberUtil::shortNumber($data['update']['total']['jumlah_meninggal']);

        $additionDeaths = NumberUtil::shortNumber($data['update']['penambahan']['jumlah_meninggal']);
        $additionCases = NumberUtil::shortNumber($data['update']['penambahan']['jumlah_positif']);
        $additionRecovered = NumberUtil::shortNumber($data['update']['penambahan']['jumlah_sembuh']);

        $positiveEmoji = Emoji::faceWithThermometer();
        $smileEmoji = Emoji::grinningFace();
        $ambulanceEmoji = Emoji::ambulance();

        return <<<EOT
Total
Positif: {$updateTotalPositive} {$positiveEmoji}
Meninggal: {$updateTotalDeaths} {$ambulanceEmoji}
Sembuh: {$updateTotalRecovered} {$smileEmoji}

Penambahan
Kasus Baru: +{$additionCases} {$positiveEmoji}
Meninggal: +{$additionDeaths} {$ambulanceEmoji}
Sembuh: +{$additionRecovered} {$smileEmoji}
EOT;
    }
}
