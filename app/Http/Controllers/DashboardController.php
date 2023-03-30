<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboard()
    {
        // Données pour le graphique à secteurs
        $leadCount = DB::table('contacts')->where('status', 'lead')->count();
        $deadLeadCount = DB::table('contacts')->where('status', 'dead_lead')->count();
        $prospectCount = DB::table('contacts')->where('status', 'prospect')->count();
        $clientCount = DB::table('contacts')->where('status', 'client')->count();
        $conversionRate = ($clientCount / ($leadCount + $deadLeadCount)) * 100;
        $data = [
            'leadCount' => $leadCount,
            'deadLeadCount' => $deadLeadCount,
            'prospectCount' => $prospectCount,
            'clientCount' => $clientCount,
            'conversionRate' => $conversionRate
        ];

        // Données pour le graphique à barres
        $currentYear = date('Y');
        $clientsByMonth = DB::table('contacts')
            ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as client_count'))
            ->where('status', 'client')
            ->whereYear('created_at', '=', $currentYear)
            ->groupBy(DB::raw('strftime("%m", created_at)'))
            ->get();

        $leadsByMonth = DB::table('contacts')
            ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as lead_count'))
            ->where('status', 'lead')
            ->whereYear('created_at', '=', $currentYear)
            ->groupBy(DB::raw('strftime("%m", created_at)'))
            ->get();

        $prospectsByMonth = DB::table('contacts')
            ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as prospect_count'))
            ->where('status', 'prospect')
            ->whereYear('created_at', '=', $currentYear)
            ->groupBy(DB::raw('strftime("%m", created_at)'))
            ->get();

        $months = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre'
        ];
        $clientCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
            if (isset($clientsByMonth[$i - 1])) {
                $clientCounts[] = $clientsByMonth[$i - 1]->client_count;
            } else {
                $clientCounts[] = 0;
            }
        }
        $barData = [
            'months' => array_values($months),
            'clientCounts' => $clientCounts,
            'leadsByMonth' => $leadsByMonth->keyBy('month'),
            'prospectsByMonth' => $prospectsByMonth->keyBy('month')
        ];
        
        return view('home', compact('data', 'barData', 'leadCount', 'deadLeadCount', 'prospectCount', 'clientCount', 'conversionRate'));
    }
}