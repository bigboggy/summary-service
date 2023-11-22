<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewSummaryRequest;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;

class ReviewSummaryController extends Controller
{
    protected OpenAIService $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function store(StoreReviewSummaryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $response = $this->openAIService->analyzeSprint($data);

        return response()->json($response, 200);
    }
}
