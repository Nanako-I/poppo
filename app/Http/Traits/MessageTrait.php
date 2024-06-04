<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

trait MessageTrait
{
    /**
     * 成功メッセージのみ
     *
     * @return array
     */
    public static function returnMessageSuccess()
    {
        $response['message'] = '';
        $response['status'] = '200';

        return $response;
    }

    /**
     * 成功メッセージ（データなし）
     *
     * @return array
     */
    public static function returnMessageNodataArray()
    {
        $data = [];
        $response['data'] = $data;
        $response['message'] = 'Not found data';

        return $response;
    }

    /**
     * 成功メッセージ（データあり）
     *
     * @return array
     */
    public static function returnMessageIndex($data, $info = '')
    {
        $response['contents'] = $data;
        if ($info) {
            $response['info'] = $info;
        }
        $response['message'] = '';
        $response['status'] = '200';

        return $response;
    }

    public static function returnMessagePaginate($data, $is_paginate = false)
    {
        $response['contents'] = $data;
        $response['message'] = '';
        $response['status'] = '200';
        if ($is_paginate) {
            $response['paginate'] = [
                'count' => $data->count(),
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'total_pages' => $data->lastPage(),
            ];
        }

        return $response;
    }

    /**
     * 成功メッセージ（ページネート用）
     *
     * @return array
     */
    public static function returnMessagePagenate($data, $array, $count)
    {
        $info = ['limit' => $array['limit'], 'offset' => $array['offset'], 'totalcount' => $count];
        $response['contents'] = $data;
        $response['info'] = $info;
        $response['message'] = '';
        $response['status'] = '200';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageError()
    {
        $response['message'] = 'error ';
        $response['status'] = '500';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorStripe()
    {
        $response['message'] = 'error ';
        $response['status'] = '402';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorStripeCard()
    {
        $response['message'] = 'error ';
        $response['status'] = '410';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorLogin()
    {
        $response['message'] = 'error ';
        $response['status'] = '401';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorRequestedDataNotFound()
    {
        $response['message'] = 'error Requested data not found';
        $response['status'] = '401';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorDebug($e)
    {
        if (config('app.debug')) {
            $response['message'] = $e->getMessage();
            $response['status'] = '500';
        } else {
            $response['message'] = 'error';
            $response['status'] = '500';
        }
        Log::error(
            '500 error',
            [
                'Message' => $e->getMessage(),
                'Filename' => $e->getFile(),
                'Line Number' => $e->getLine(),
                'Trace' => $e->getTraceAsString(),
            ]
        );

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageError404()
    {
        $response['message'] = 'error ';
        $response['status'] = '404';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorNoAuthority()
    {
        $response['message'] = 'error no authority';
        $response['status'] = '400';

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageErrorRole()
    {
        $response['message'] = 'not authorized';
        $response['status'] = '403';

        return $response;
    }

    public static function messageErrorStatusText($message = '')
    {
        $response['message'] = 'error ';
        $response['status'] = '500';
        $response['statusText'] = $message;

        return $response;
    }

    public static function messageErrorMaxFileSize()
    {
        $response['message'] = '合計200MB以下のファイルを添付してください';
        $response['status'] = '400';

        return $response;
    }

    public static function messageAwsPinPointMessageResponse($data, $tel)
    {
        $response['status'] = $data->get('MessageResponse')['Result'][config('constants.country_code') . $tel]['StatusCode'];
        $response['message'] = $data->get('MessageResponse')['Result'][config('constants.country_code') . $tel]['StatusMessage'];

        return $response;
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public static function messageBadRequest()
    {
        $response['message'] = 'bat request';
        $response['status'] = '400';

        return $response;
    }
}
