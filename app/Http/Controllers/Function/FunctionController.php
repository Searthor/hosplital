<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\FunctionAvailable;
use App\Models\FunctionModel;
use App\Models\Patient;
use App\Models\Treatments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function check_permission($function_name)
    {
        $check_permission =  FunctionAvailable::where('role_id', auth()->user()->role_id)->where('function_id', FunctionModel::where('name', $function_name)->first()->id ?? 0)->first();
        if ($check_permission) {
            return true;
        }
        return false;
    }
    public function check_admin()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2  || auth()->user()->role_id == 3) {
            return true;
        }
        return false;
    }
    public function check_select_guanrantee($select_guanrantee, $id)
    {
        foreach ($select_guanrantee as $item) {
            if ($id == $item) {
                return  true;
            }
        }
        return false;
    }
    public function generate_code($type)
    {
        // Fetch the last patient code
        // Fetch the last patient code
        if ($type == 'Patient') {
            $last_patient = Patient::orderBy('id', 'desc')->first();
        }
        if ($type == 'Treatments') {
            $last_patient = Treatments::orderBy('id', 'desc')->first();
        }

        if ($type == 'user') {
            $last_patient = User::orderBy('id', 'desc')->first();
        }


        // Check if there's an existing code
        $last_code = $last_patient ? $last_patient->code : '000000';

        // Extract numeric part of the code
        $numeric_part = intval(substr($last_code, 3));

        // Increment numeric part by 1
        $new_numeric_part = str_pad($numeric_part + 1, 6, '0', STR_PAD_LEFT); // Changed to 6 digits

        // Construct the new code
        $new_code = $new_numeric_part;

        return $new_code;

        return $new_code;
    }



    // public function generate_code($type)
    // {
    //     $check_code = Patient::orderBy('id', 'desc')->first();
    //     if ($type == 'Patient') {
    //         $code = !empty($check_code->code) ?  $check_code->code : 0;
    //     }


    //     if (intval($code) < 10000) {
    //         if (intval(substr($code, 1, 4)) <= 99 && intval(substr($code, 1, 4)) >= 9) {
    //             return '000' . (intval(substr($code, 1, 4))  + 1);
    //         } elseif (intval(substr($code, 1, 4)) <= 999 && intval(substr($code, 1, 4)) >= 99) {
    //             return '00' . (intval(substr($code, 1, 4))  + 1);
    //         } elseif (intval(substr($code, 1, 4)) <= 9999 && intval(substr($code, 1, 4)) >= 999) {
    //             return '0' . (intval(substr($code, 1, 4))  + 1);
    //         } else if (intval(substr($code, 4, 1)) < 10 && intval(substr($code, 4, 1)) >= 0) {
    //             return '0000' . (intval(substr($code, 4, 1)) + 1);
    //         } else {
    //             return intval($code) + 1;
    //         }
    //     } else {
    //         return intval($code) + 1;
    //     }
    //     return $code;

    // }
    public function cal_age($date)
    {
        $dob = Carbon::createFromFormat('Y-m-d', $date);
        $now = Carbon::now();
        return $dob->diffInYears($now);
    }
    public function check_select_sector($data, $id)
    {
        foreach ($data as $item) {
            if ($item->sectors_id == $id) {
                return true;
            }
        }
        return false;
    }
    public function check_pay_interest($type)
    {
        if ($type == 'pay_interest') {
            return  true;
        }
        return false;
    }
    public function cal_history_loan($cus_id, $type)
    {
        $data = [];
        $all_data  = Credit::where('customers_id', $cus_id)->where('interest_type', $type)->get();
        $total_price = 0;
        $total_rate = 0;
        $total_qty_time = 0;
        $total_price_per_month = 0;
        $total_rate_month = 0;
        $total_fee = 0;
        foreach ($all_data  as $item) {
            $total_price += $item->money_number;
            $total_rate += $item->interest;
            $total_qty_time += $item->qty_time;
            $total_price_per_month += $item->money_number / $item->qty_time;
            $total_rate_month += $item->money_number * ($item->interest / 100);
            $total_fee += $item->total_fee;
        }
        $data[] = [
            'total_price' => $total_price,
            'total_rate' =>  $total_rate,
            'total_qty_time' =>  $total_qty_time,
            'total_price_per_month' => $total_price_per_month,
            'total_rate_month' =>  $total_rate_month,
            'total_fee' =>  $total_fee,
            'type' => $total_price > 0 ?  $type : ''
        ];
        return $data;
    }
}
