<?php

namespace App\Http\Controllers;

use App\Http\Requests\Calender\CalenderDeleteRequest;
use App\Http\Requests\Calender\CalenderRegisterRequest;
use App\Http\Traits\MessageTrait;
use App\Models\Person;
use App\Models\ScheduledVisit;
use App\Models\VisitType;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CalenderController extends Controller
{
    use MessageTrait;

    /**
     * 利用者一覧を取得
     *
     * @return JsonResponse
     */
    public function indexPerson()
    {
        try {
            // Personモデル=peopleテーブル
            $data = Person::all();
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
     * @return JsonResponse
     */
    public function indexScheduledVisit()
    {
        try {
            $schedules = ScheduledVisit::all();
            if ($schedules->isEmpty()) {
                $response = self::returnMessageNodataArray();
                $status = Response::HTTP_NO_CONTENT;
            }
            $schedules->each(function ($schedule) {
                $schedule->type = VisitType::find($schedule->visit_type_id)->type;
                $schedule->person_name = Person::find($schedule->people_id)->person_name;
            });
            $response = self::returnMessageIndex($schedules);
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
