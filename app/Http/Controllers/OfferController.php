<?php

namespace App\Http\Controllers;

use App\Models\ClaimReward;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class OfferController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getOffer(Request $request)
    {
        $data = $this->validate($request,[
            'email' => 'required|email',
            'deviceId' => 'required',
            'score' => 'required',
        ]);
        $date_now = Carbon::now()->format("Y-m-d");
        if (env('APP_DEBUG',false)){
            $date_now = $request->query('date',date("Y-m-d"));
        }
        $special_offer = false;
        if ($claimReward = ClaimReward::with("offer")
            ->where('claim_date', $date_now)
            ->where('email', $data['email'])
            ->where('device_id', $data['deviceId'])
            ->first()
        ) {
            if ($claimReward->status){
                return response()->json([
                    "status" => "failed",
                    "message" => "reward has claimed",
                    "data" => null
                ],Response::HTTP_BAD_REQUEST);
            }
        } else {
            if ($this->isWeekend($date_now) || $this->isSpecialDate($date_now)) {
                $special_offer = true;
            }
            $offer = Offer::where('special', $special_offer)->where('active', true)->inRandomOrder()->first();
            $claimReward = ClaimReward::create([
                'claim_date' => $date_now,
                'email' => $data['email'],
                'device_id' => $data['deviceId'],
                'score' => $data['score'],
                'status' => false,
                'offer_id' => $offer->id
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "success get reward",
            "data" => [
                "rewardId" => $claimReward->offer->reward_id,
                "loyaltyId" => $claimReward->offer->loyalty_id,
                "special" => $claimReward->offer->special
            ]
        ]);
    }

    public function claimOffer(Request $request){
        $data = $this->validate($request,[
            'email' => 'required|email',
            'deviceId' => 'required',
            'rewardId' => 'required',
        ]);
        $date_now = Carbon::now()->format("Y-m-d");
        if (env('APP_DEBUG',false)){
            $date_now = $request->query('date',date("Y-m-d"));
        }
        $offer = Offer::where('reward_id', $data['rewardId'])->where('active', true)->first();
        if (!$offer){
            return response()->json([
                "status" => "failed",
                "message" => "offer not found or not active",
                "data" => null
            ], Response::HTTP_NOT_FOUND);
        }
        if ($claimReward = ClaimReward::where('claim_date', $date_now)
            ->where('email', $data['email'])
            ->where('device_id', $data['deviceId'])
            ->where('offer_id', $offer->id)
            ->first()
        ) {
            if ($claimReward->status){
                return response()->json([
                    "status" => "failed",
                    "message" => "reward has claimed",
                    "data" => null
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "data not found",
                "data" => null
            ], Response::HTTP_NOT_FOUND);
        }
        $claimReward->status = true;
        $claimReward->save();
        return response()->json([
            "status" => "success",
            "message" => "success claim reward",
            "data" => null
        ]);
    }
}
