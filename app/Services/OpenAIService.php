<?php

namespace App\Services;

use App\Models\ReviewSummaryRequest;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

class OpenAIService
{
    /**
     * @param $data
     * @param $roomId
     * @return CreateResponse
     */
    public function analyzeSprint($data, $roomId): CreateResponse
    {
        $dataString = json_encode($data, JSON_PRETTY_PRINT);
        $instruction = "The team finished the daily standup meeting. Thank the team for the attendance.
        Analyze this day of sprint compared to last sprint, pretend to be a scrum master, use emojis to highlight things,
        you can also make suggestions to boost morale using this dataset,
        if any of the scores are lower than last sprint then it's a bad thing.
        (note the progress, done, open are story points, morale is highest 20 and lowest 0): \n" . $dataString;

        $response = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $instruction,
            'max_tokens' => 150,
        ]);

        $responseText = $response['choices'][0]['text'] ?? null;

        ReviewSummaryRequest::updateOrCreate(
            ['room_id' => $roomId],
            ['response_text' => $responseText]
        );

        return $response;
    }

    /**
     * @param $data
     * @param $roomId
     * @return ReviewSummaryRequest
     */
    public function storeRequest($data, $roomId): ReviewSummaryRequest
    {
        $reviewSummaryRequest = new ReviewSummaryRequest();

        $reviewSummaryRequest->room_id = $roomId;
        $reviewSummaryRequest->current_sprint_day = $data['currentSprint']['day'];
        $reviewSummaryRequest->current_sprint_current_morale = $data['currentSprint']['currentMorale'];
        $reviewSummaryRequest->current_sprint_progress = $data['currentSprint']['progress'];
        $reviewSummaryRequest->current_sprint_done = $data['currentSprint']['done'];
        $reviewSummaryRequest->current_sprint_open = $data['currentSprint']['open'];
        $reviewSummaryRequest->current_sprint_blocked = json_encode($data['currentSprint']['blocked']);

        $reviewSummaryRequest->last_sprint_day = $data['lastSprint']['day'];
        $reviewSummaryRequest->last_sprint_current_morale = $data['lastSprint']['currentMorale'];
        $reviewSummaryRequest->last_sprint_progress = $data['lastSprint']['progress'];
        $reviewSummaryRequest->last_sprint_done = $data['lastSprint']['done'];
        $reviewSummaryRequest->last_sprint_open = $data['lastSprint']['open'];
        $reviewSummaryRequest->last_sprint_blocked = isset($data['lastSprint']['blocked']) ? json_encode($data['lastSprint']['blocked']) : null;

        $reviewSummaryRequest->save();

        return $reviewSummaryRequest;
    }
}
