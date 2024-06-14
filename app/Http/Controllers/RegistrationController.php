<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\StoreOrDeleteRegistrationRequest;
use App\Models\Activity;
use App\Models\Registration;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct(private Activity $activities, private Registration $registrations)
    {
    }

    public function storeOrDeleteRregistration(StoreOrDeleteRegistrationRequest $request)
    {
        $data = $request->validated();
        $activity = $this->activities->findData(['id' => $data[Registration::activityId]]);
        $registrationCount = Registration::where([Registration::activityId => $activity->id])->count();
        if ($activity[Activity::registrationEnd] < now() || $activity[Activity::maxMembers] <= $registrationCount) {
            return ResponseHelper::invalidData();
        }
        $data[Registration::userId] = $request->user()->id;
        $registration = $this->registrations->findData($data);
        if (!empty($registration)) {
            $deleteRegistration = $this->registrations->forceDeleteData(['id' => $registration->id]);
            if (empty($deleteRegistration))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('deleted registration');
        } else {
            $createRegistration = $this->registrations->createData($data);
            if (empty($createRegistration))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('added registration');
        }
    }
}
