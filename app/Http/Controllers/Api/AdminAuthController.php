<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Http\Requests\Admin\AdminForgotPasswordRequest;
use App\Http\Requests\Admin\AdminResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\ApiResponseService as ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    /**
     * Admin Register
     */
    public function register(AdminRegisterRequest $request)
    {
        $admin = Admin::create($request->validated());
        $token = $admin->createToken('admin_api_token')->plainTextToken;
                        return ApiResponse::success('Admin registered successfully', [
                                    'admin' => $admin->only('id','name','email'),
                                    'token' => $token,
                                ], 201);
    }

    /**
     * Admin Login
     */
    public function login(AdminLoginRequest $request)
    {
        // Find Admin
        $admin = Admin::select('id', 'name', 'email', 'password')
                    ->where('email', $request->email)
                    ->first();

        // Check Credentials
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return ApiResponse::error('Invalid email or password', [], 401);
        }

        // Delete old tokens for security
        $admin->tokens()->delete();

        // Create new access token
        $token = $admin->createToken('admin_api_token')->plainTextToken;

        // Return success response
        return ApiResponse::success('Login successful', [
            'admin' => $admin->only(['id', 'name', 'email']),
            'token' => $token,
        ]);
    }

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Admin logged out successfully');
    }



    public function forgotPassword(AdminForgotPasswordRequest $request)
    {
        $token = Str::random(60);
        DB::table('admin_password_reset_tokens')
            ->updateOrInsert(
                ['email' => $request->email],
                ['token' => $token, 'created_at' => now()]
            );

        return ApiResponse::success('Password reset token generated', [
            'reset_token' => $token
        ]);
    }

    public function resetPassword(AdminResetPasswordRequest $request)
    {
        $record = DB::table('admin_password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return ApiResponse::error('Invalid token or email', [], 400);
        }

        Admin::where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('admin_password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return ApiResponse::success('Password has been reset successfully');
    }
}
