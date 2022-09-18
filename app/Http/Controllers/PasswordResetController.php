<?php

namespace App\Http\Controllers;

use App\DbModels\PasswordReset;
use App\Http\Requests\PasswordReset\GeneratePinRequest;
use App\Http\Requests\PasswordReset\PasswordResetRequest;
use App\Http\Requests\PasswordReset\VerifyByPinRequest;
use App\Http\Resources\PasswordResetResource;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\PasswordResetRepository;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    /**
     * @var PasswordResetRepository
     */
    protected $passwordResetRepository;

    /**
     * PasswordResetController constructor.
     * @param PasswordResetRepository $passwordResetRepository
     */
    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  GeneratePinRequest  $request
     * @return JsonResponse
     */
    public function generateResetPin(GeneratePinRequest $request): JsonResponse
    {
        $this->passwordResetRepository->save($request->all());

        return response()->json(['status' => 200, 'message' => 'An OTP has been sent to your email/phone'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param PasswordResetRequest $request
     * @return JsonResponse
     */
    public function resetPassword(PasswordResetRequest $request): JsonResponse
    {
        $passwordReset = $this->passwordResetRepository->getAValidAccessRequestWithPin($request->get('pin'), []);

        if (!$passwordReset instanceof PasswordReset) {
            return response()->json(['status' => 404, 'message' => 'Pin is invalid.'], 404);
        }

        $user = $this->passwordResetRepository->resetPassword($passwordReset->user, $request->all());

        $this->passwordResetRepository->delete($passwordReset);

        return response()->json(['status' => 201, 'message' => 'Password has been reset.', 'user' => new UserResource($user)], 201);

    }
}
