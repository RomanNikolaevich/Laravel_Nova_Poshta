<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 * calculation of the cost of delivery of goods Nova Poshta
 */
class DeliveryCostService
{

    /**
     * @param Request $request
     *
     * @return float|int
     */
    public function deliveryCost(Request $request):float|int
    {
        $packageCost = $request->input('packageCost');

        if ($packageCost < 1000) {
            return 50 + ($packageCost * 0.5);
        }

        if ($packageCost < 3000) {
            return 50 + ($packageCost * 0.3);
        }

        return 0;
    }
}
