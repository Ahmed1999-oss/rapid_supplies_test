<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordOtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $validator->errors()->first(), 'Validation Error');
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otpCode = rand(100000, 999999);
            DB::table('password_resets_otp')->updateOrInsert(
                ['email' => $request->email],
                ['otp' => $otpCode, 'created_at' => Carbon::now()]
            );

            Mail::to($user->email)->send(new OtpMail($otpCode));

            return $this->sendResponse(true, Response::HTTP_OK, 'OTP sent to your email address.', null);

        } else {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, 'Email not found.', null);

        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $validator->errors()->first(), 'Validation Error');
        }

        $otpRecord = DB::table('password_resets_otp')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, 'Invalid OTP.', null);
        }

        if (Carbon::parse($otpRecord->created_at)->addMinutes(15)->isPast()) {
            return response()->json(['message' => 'OTP expired'], 400);
        }
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets_otp')->where('email', $request->email)->delete();
        
        return $this->sendResponse(true, Response::HTTP_OK, 'Password reset successfully.', null);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $userId = auth()->user()->id;

        if ($validator->fails()) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $validator->errors()->first(), 'Validation Error');
        }

        $user = User::where('id', $userId)->first();

        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, 'Invalid old password.', null);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return $this->sendResponse(true, Response::HTTP_OK, 'Password change successfully.', null);
    }
}
