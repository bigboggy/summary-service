<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

class OpenAIService
{
    public function analyzeSprint($data): CreateResponse
    {
        $dataString = json_encode($data, JSON_PRETTY_PRINT);
        $instruction = "The team finished the daily standup meeting. Thank the team for the attendance.
        Analyze this day of sprint compared to last sprint, pretend to be a scrum master, use emojis to highlight things,
        you can also make suggestions to boost morale using this dataset,
        if any of the scores are lower than last sprint then it's a bad thing.
        (note the progress, done, open are story points, morale is highest 20 and lowest 0): \n" . $dataString;

        return OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $instruction,
            'max_tokens' => 150,
        ]);
    }
}
