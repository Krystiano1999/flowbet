<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Services\CouponService;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{
    private CouponService $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    /**
     * Store a new coupon.
     *
     * @param StoreCouponRequest $request
     * @return JsonResponse
     */
    public function store(StoreCouponRequest $request): JsonResponse
    {
        try {
            $coupon = $this->couponService->createCoupon($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Kupon został dodany pomyślnie!',
                'coupon' => $coupon,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Wystąpił błąd podczas dodawania kuponu.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
