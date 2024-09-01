<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BeforeInvitationController extends Controller
{
    public function registrationConfirmation(Request $request)
{
    $user = auth()->user();
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    $firstFacility = $facilities->first();
    $facilityId = $firstFacility->id; // $firstFacilityのIDを取得
    // return view('custom_id_entryform', compact( 'facilityId',));
    return view('before-invitation', compact('facilityId'));
}

    public function beforeInvitation(Request $request, $id)
{
    $user = auth()->user();
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    $firstFacility = $facilities->first();
    $facilityId = $firstFacility->id; // $firstFacilityのIDを取得
    // return view('custom_id_entryform', compact( 'facilityId',));
    return view('before-invitation', compact('facilityId'));
}
}