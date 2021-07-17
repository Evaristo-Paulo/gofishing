<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{


    public function statsActivities($year)
    {
        $data = \DB::select("SELECT DATE_PART('year', solds.created_at) as year, DATE_PART('month', solds.created_at) as month, SUM(solds.qty) as qty FROM solds WHERE DATE_PART('year', solds.created_at) = ?  GROUP BY( month, year)", [$year]);

        $stats = [];
        $months = Month::all();

        foreach ($months as $month) {
            $sentinela = false;
            foreach ($data as $dt) {
                if ($dt->month == $month->id) {
                    $sentinela = true;
                    array_push($stats, $dt->qty);
                }
            }

            if (!$sentinela) {
                array_push($stats, 0);
            }
        }
        return $stats;
    }
}
