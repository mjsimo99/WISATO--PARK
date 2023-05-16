<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        redirect()->route('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //data for barchart
        $categories = Category::where('categories.status', 1)
            ->orderBy('categories.type', 'ASC')
            ->withCount(['slots as booked' => function ($query) {
                $query->where('status', '1')->whereHas('floor', function ($query) {
                    $query->where('status', '1');
                })->has('active_parking');
            }])->withCount(['slots as available' => function ($query) {
                $query->where('status', '1')->whereHas('floor', function ($query) {
                    $query->where('status', '1');
                })->doesnthave('active_parking');
            }])->get();

        $barChart['labels'] = $categories->pluck('type')->toArray();

        $slots = $categories->sum('available') + $categories->sum('booked');
        $barChart['availableData'] = $categories->pluck('available')->toArray();
        $barChart['bookedData'] = $categories->pluck('booked')->toArray();
        //bar chart end

        //data for line chart
        $lineChartData = [];

        $data['lineChart']['dateFrom'] = Carbon::now()->addMonth()->subYear()->format('M Y');
        $data['lineChart']['dateTo'] = Carbon::now()->format('M Y');

        $parkingMonthly = Parking::whereDate('out_time', '>=', Carbon::now()->addMonth()->subYear()->format('Y-m') . '-01')
            ->groupBy('month')
            ->orderBy('month')
            ->get([
                DB::raw('DATE_FORMAT( out_time, "%b") as month'),
                DB::raw('sum(amount) as "amount"')
            ])->pluck('amount', 'month');

        $previousDate = Carbon::now()->subYear();
        foreach (range(11, 0) as $i) {
            $date = $previousDate->addMonth()->format('M');
            $monthlyAmount = (isset($parkingMonthly[$date]) ? $parkingMonthly[$date] : 0);
            $lineChartData[$date] = $monthlyAmount;
        }

        $data['lineChart']['labels'] = array_keys($lineChartData);
        $data['lineChart']['data'] = array_values($lineChartData);
        $data['lineChart']['totalAmount'] = array_sum($data['lineChart']['data']);
        //line chart end

        $data['barChart'] = $barChart;
        $data['today_amount'] = Parking::whereDate('out_time', date('Y-m-d'))->sum('amount');
        $data['this_month_amount'] = Parking::whereMonth('out_time', date('m'))->whereYear('out_time', date('Y'))->sum('amount');
        $data['this_year_amount'] = Parking::whereYear('out_time', date('Y'))->sum('amount');
        $data['currently_parking'] = Parking::where('out_time', NULL)->count();
        $data['total_slots'] = $slots;

        return view('home', compact('data'));
    }
}
