<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Services\CouponService;
use Illuminate\Http\JsonResponse;
use App\Models\Coupon;

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

    /**
     * Get a coupon grouped by steps.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $coupons = $this->couponService->getCouponsGroupedByStep();

        return response()->json([
            'success' => true,
            'coupons' => $coupons,
        ]);
    }

    /**
     * Remove coupon.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->couponService->deleteCoupon($id);

            return response()->json([
                'success' => true,
                'message' => 'Kupon został pomyślnie usunięty.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nie udało się usunąć kuponu.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing coupon.
     *
     * @param int $id
     * @param \App\Http\Requests\UpdateCouponRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateCouponRequest $request): JsonResponse
    {
        \Log::info('Request hit update method', ['id' => $id, 'data' => $request->all()]);

        try {
            $coupon = $this->couponService->updateCoupon($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Kupon został pomyślnie zaktualizowany!',
                'coupon' => $coupon,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Wystąpił błąd podczas edycji kuponu.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a single coupon by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $coupon = $this->couponService->getCouponById($id);

            return response()->json([
                'success' => true,
                'coupon' => $coupon,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nie udało się pobrać kuponu.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
