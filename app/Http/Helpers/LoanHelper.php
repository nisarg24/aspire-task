<?php
use \Carbon\Carbon;

if (!function_exists('generateCode')) {
    function generateCode($model) {
        $id = 0;
        if ($model) {
            $id = $model->id;
        }
        return '#'.str_pad($id + 1, 8, "0", STR_PAD_LEFT);
    }
}

if (!function_exists('calculateLoanEndDate')) {
    function calculateLoanEndDate($request) {
        $startDate = Carbon::parse($request->start_date);
        $isMonth = $request->is_month;
        $term = $request->term;
        if ($isMonth) {
            $endDate = $startDate->addMonths($term);
        } else {
            $endDate = $startDate->addYears($term);
        }
        return $endDate;
    }
}

if (!function_exists('calculateWeeklyPrice')) {
    function calculateWeeklyPrice($loan) {
        $startDate = Carbon::parse($loan->start_date);
        $endDate = Carbon::parse($loan->end_date);

        $diffInWeeks = $startDate->diffInWeeks($endDate);
        $weeklyPrice = round($loan->amount / 13, 2);//$diffInWeeks;
        
        for($i=1; $i<=$diffInWeeks; $i++) {
            $weeklyData[$i]['payment_price'] = $weeklyPrice;
            $weeklyData[$i]['payment_date'] = $startDate->addWeek()->format('Y-m-d');
        }

        return $weeklyData;
    }
}