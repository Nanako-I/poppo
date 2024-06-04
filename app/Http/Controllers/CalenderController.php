<?php

namespace App\Http\Controllers;

use App\Http\Requests\Calender\CalenderDeleteRequest;
use App\Http\Requests\Calender\CalenderEditRequest;
use App\Http\Requests\Calender\CalenderIndexPersonRequest;
use App\Http\Requests\Calender\CalenderIndexScheduledVisitRequest;
use App\Http\Requests\Calender\CalenderRegisterRequest;
use App\Http\Requests\Calender\CalenderScheduledVisitDetailRequest;
use App\Http\Traits\MessageTrait;
use App\Models\Person;
use App\Models\ScheduledVisit;
use App\Models\VisitType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller
{
    use MessageTrait;

    /**
     * 利用者一覧を取得
     *
     * @param CalenderIndexPersonRequest $request
     * @return JsonResponse
     */
    public function indexPerson(CalenderIndexPersonRequest $request)
    {
        $form_request = new CalenderIndexPersonRequest();
        $form_request->authorize($request);
        try {
            $user = Auth::user();
            $facility = $user->facility_staffs()->first();
            if ($facility) {
                $people = $facility->people_facilities()->get();
                $response = $people->isNotEmpty() ? self::returnMessageIndex($people) : self::returnMessageNodataArray();
                $status = $people->isNotEmpty() ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
            } else {
                $response = self::returnMessageNodataArray();
                $status = Response::HTTP_NO_CONTENT;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }

    /**
     * 訪問タイプ一覧を取得
     *
     * @return JsonResponse
     */
    public function indexVisitType()
    {
        try {
            $data = VisitType::all();
            if ($data->isEmpty()) {
                $response = self::returnMessageNodataArray();
                $status = Response::HTTP_NO_CONTENT;
            }
            $response = self::returnMessageIndex($data);
            $status = Response::HTTP_OK;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }

    /**
     * 訪問スケジュール一覧を取得
     *
     * @param CalenderIndexScheduledVisitRequest $request
     * @return JsonResponse
     */
    public function indexScheduledVisit(CalenderIndexScheduledVisitRequest $request)
    {
        $form_request = new CalenderIndexScheduledVisitRequest();
        $form_request->authorize($request);
        try {
            $user = Auth::user();
            $facility = $user->facility_staffs()->first();
            if ($facility) {
                $people = $facility->people_facilities()->get();
                if ($people) {
                    $peopleIds = $people->pluck('id');
                    $scheduled_visits = ScheduledVisit::whereIn('people_id', $peopleIds)->get();
                    $scheduled_visits->each(function ($schedule) {
                        $schedule->type = VisitType::find($schedule->visit_type_id)->type;
                        $schedule->person_name = Person::find($schedule->people_id)->person_name;
                    });
                    $response = self::returnMessageIndex($scheduled_visits);
                    $status = Response::HTTP_OK;
                } else {
                    $response = self::returnMessageNodataArray();
                    $status = Response::HTTP_NO_CONTENT;
                }
            } else {
                $response = self::returnMessageNodataArray();
                $status = Response::HTTP_NO_CONTENT;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }

    /**
     * 特定の訪問予定を取得
     *
     * @param CalenderScheduledVisitDetailRequest $request
     * @return JsonResponse
     */
    public function getScheduledVisitDetail(CalenderScheduledVisitDetailRequest $request)
    {
        $array = CalenderScheduledVisitDetailRequest::getOnlyRequest($request);

        try {
            $schedule = ScheduledVisit::find($array['scheduled_visit_id']);
            if (!$schedule) {
                $response = self::returnMessageNodataArray();
                $status = Response::HTTP_NO_CONTENT;
            }
            $response = self::returnMessageIndex($schedule);
            $status = Response::HTTP_OK;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }

    /**
     * カレンダーに利用者の訪問予定を登録する
     *
     * @param CalenderRegisterRequest $request
     * @return JsonResponse
     */
    public function register(CalenderRegisterRequest $request)
    {
        $array = CalenderRegisterRequest::getOnlyRequest($request);

        DB::beginTransaction();
        try {
            ScheduledVisit::create([
                'people_id' => $array['people_id'],
                'arrival_datetime' => $array['arrival_datetime'],
                'exit_datetime' => $array['exit_datetime'],
                'visit_type_id' => $array['visit_type_id'],
                'notes' => $array['notes'],
            ]);
            DB::commit();
            $response = self::returnMessageIndex(true);
            $status = Response::HTTP_OK;
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }

    /**
     * カレンダーに利用者の訪問予定をを編集する
     *
     * @param CalenderEditRequest $request
     * @return JsonResponse
     */
    public function edit(CalenderEditRequest $request)
    {
        $array = CalenderEditRequest::getOnlyRequest($request);

        // nullでない値のみを抽出
        $updateData = array_filter($array, function ($value) {
            return !is_null($value);
        });

        DB::beginTransaction();
        try {
            ScheduledVisit::where('people_id', $array['people_id'])
                ->update($updateData);
            DB::commit();
            $response = self::returnMessageIndex(true);
            $status = Response::HTTP_OK;
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }


    /**
     * カレンダーの訪問予定を削除する
     *
     * @param CalenderDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(CalenderDeleteRequest $request)
    {
        $array = CalenderDeleteRequest::getOnlyRequest($request);

        DB::beginTransaction();
        try {
            $schedule = ScheduledVisit::find($array['schedule_id']);
            if ($schedule) {
                $schedule->delete();
                $response = self::returnMessageIndex(true);
                $status = Response::HTTP_OK;
            } else {
                throw new \Exception('No schedule found.');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $response = self::messageErrorStatusText($message);
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json($response, $status);
    }
};
