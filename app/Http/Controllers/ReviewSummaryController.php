<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewSummaryRequest;
use App\Models\ReviewSummaryRequest;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ReviewSummaryController extends Controller
{
    protected OpenAIService $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Get all review summaries for a room
     * @param $roomId
     * @return JsonResponse
     */
    public function index($roomId): JsonResponse
    {
        $reviewSummaries = ReviewSummaryRequest::where('room_id', $roomId)->get();

        if (count($reviewSummaries) === 0) {
            return response()->json([
                'message' => 'No review summaries found for this room.'
            ], 404);
        }

        return response()->json($reviewSummaries);
    }

    /**
     * Validate the request and analyze the sprint data
     * @param StoreReviewSummaryRequest $request
     * @param $roomId
     * @return JsonResponse
     */
    public function store(StoreReviewSummaryRequest $request, $roomId): JsonResponse
    {
        try {
            // Get validated data from the request
            $data = $request->validated();

            // Store the request data in the database
            $this->openAIService->storeRequest($data, $roomId);

            // Analyze the sprint data
            $response = $this->openAIService->analyzeSprint($data, $roomId);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Error in storing and analyzing sprint data: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
