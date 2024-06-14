<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rating\StoreRatingRequest;
use App\Models\Activity;
use App\Models\Rating;
use App\Models\Registration;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct(private Rating $ratings, private Registration $registrations, private Activity $activities,)
    {
    }

    public function storeRating(StoreRatingRequest $request)
    {
        $data = $request->validated();
        $data[Registration::userId] = $request->user()->id;
        $activity = $this->activities->findData(['id' => $data[Rating::activityId]]);
        $registration = $this->registrations->findData([
            Registration::activityId => $data[Registration::activityId],
            Registration::userId => $data[Registration::userId]
        ]);
        $getRating = $this->ratings->findData([
            Rating::activityId => $data[Rating::activityId],
            Rating::userId => $data[Rating::userId]
        ]);
        if (empty($registration) || $activity[Activity::endAt] > now() || (!empty($getRating))) {
            return ResponseHelper::invalidData();
        }
        $createRating = $this->ratings->createData($data);
        if (empty($createRating))
            return ResponseHelper::operationFail();
        return ResponseHelper::create('added rating ');
    }
}
