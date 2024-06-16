<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {

        $ordersCount = Order::count();
        $productsCount = Product::count();
        $reviewsCount = ProductComment::count();
        $usersCount = User::count();

        $currentDate = now()->toDateString();
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Fetch revenue for day, week, month, and year
        $revenueDay = $this->calculateRevenue($currentDate, $currentDate);
        $revenueWeek = $this->calculateRevenue($startOfWeek, $endOfWeek);
        $revenueMonth = $this->calculateRevenue($startOfMonth, $endOfMonth);
        $revenueYear = $this->calculateRevenue($startOfYear, $endOfYear);
        $top10Products = $this->getTop10ProductsByQuantitySold();
        $top5Products = $this->getTop5ProductsSoldThisWeek();
        $latestOrders = Order::with('orderDetails') // Assuming you have an 'order_details' relationship in your Order model
        ->orderByDesc('created_at')
            ->limit(3)
            ->get();
//        dd($latestOrders);

        return view('admin.adminDashboard',compact('ordersCount',
            'usersCount',
            'reviewsCount',
            'productsCount',
            'revenueYear',
            'revenueMonth',
            'revenueWeek',
            'revenueDay',
        ));
    }


    private function calculateRevenue($startDate, $endDate)
    {
        // Calculate revenue for the given date range
        $revenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with('orderDetails') // Ensure OrderDetails are eager loaded
            ->get()
            ->sum(function ($order) {
                // Calculate total revenue for each order
                return $order->orderDetails->sum(function ($detail) {
                    return $detail->qty * $detail->amount;
                });
            });

        return $revenue;
    }

    public function getOrdersForChart()
    {
        // Fetch orders for the last 7 days
        $startDate = Carbon::now()->subDays(50); // Start date is 7 days ago
        $endDate = Carbon::now(); // End date is today

        // Query to fetch count of orders per day
        $ordersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Prepare data for the chart
        $labels = $ordersData->pluck('date')->toArray(); // Array of dates
        $dataset = [
            [
                'label' => 'Number of Orders',
                'backgroundColor' => 'rgba(60,141,188,0.9)',
                'borderColor' => 'rgba(60,141,188,0.8)',
                'pointRadius' => false,
                'pointColor' => '#3b8bba',
                'pointStrokeColor' => 'rgba(60,141,188,1)',
                'pointHighlightFill' => '#fff',
                'pointHighlightStroke' => 'rgba(60,141,188,1)',
                'data' => $ordersData->pluck('count')->toArray() // Array of order counts
            ]
        ];

        return response()->json([
            'labels' => $labels,
            'dataset' => $dataset
        ]);
    }

    public function getTodayOrderStatusData()
    {
        // Define all possible order statuses
        $ORDER_STATUS_RECEIVEORDERS = 1;
        $ORDER_STATUS_CONFIRMED = 2;
        $ORDER_STATUS_SHIPPING = 3;
        $ORDER_STATUS_FINISH = 4;
        $ORDER_STATUS_CANCEL = 5;

        $ORDER_STATUS = [
            $ORDER_STATUS_RECEIVEORDERS => 'Orders received',
            $ORDER_STATUS_CONFIRMED => 'Confirmed',
            $ORDER_STATUS_SHIPPING => 'Shipping',
            $ORDER_STATUS_FINISH => 'Finished',
            $ORDER_STATUS_CANCEL => 'Canceled',
        ];

        // Fetch orders data for today grouped by status
        $today = Carbon::today();

        // Initialize counts for all statuses to 0
        $orderCounts = [
            $ORDER_STATUS_RECEIVEORDERS => 0,
            $ORDER_STATUS_CONFIRMED => 0,
            $ORDER_STATUS_SHIPPING => 0,
            $ORDER_STATUS_FINISH => 0,
            $ORDER_STATUS_CANCEL => 0,
        ];

        // Query to get counts of orders for each status
        $ordersData = Order::select('status', DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', $today)
            ->groupBy('status')
            ->get();

        // Populate the counts from the query result
        foreach ($ordersData as $order) {
            $orderCounts[$order->status] = $order->count;
        }

        // Prepare data for the chart
        $labels = [];
        $data = [];
        $backgroundColors = ['#f56954', '#00a65a', '#f39c12', '#3c8dbc', '#d2d6de'];

        // Populate labels and data arrays
        foreach ($ORDER_STATUS as $status => $label) {
            $labels[] = $label;
            $data[] = $orderCounts[$status];
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'backgroundColors' => $backgroundColors
        ]);
    }
    public function getTop10ProductsByQuantitySold()
    {
        $topProducts = DB::table('product_details')
            ->select('product_id', DB::raw('SUM(qty) as total_quantity_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity_sold')
            ->limit(10)
            ->get();

        return $topProducts;
    }
    public function getTop5ProductsSoldThisWeek()
    {
        // Get the start and end date of the current week
        $startOfWeek = Carbon::now()->startOfWeek();  // Monday of the current week
        $endOfWeek = Carbon::now()->endOfWeek();      // Sunday of the current week

        $topProducts = DB::table('product_details')
            ->select('product_id', DB::raw('SUM(qty) as total_quantity_sold'))
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('product_id')
            ->orderByDesc('total_quantity_sold')
            ->limit(5)
            ->get();

        return $topProducts;
    }
}
