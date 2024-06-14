<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Award;
use App\Models\Item;
use App\Models\Post;
use App\Models\User;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{

    public function statistics(Request $request)
    {
        $statistics = [
            'user_count' => User::count(),
            'post_count' => Post::count(),
            'activity_count' => Activity::count(),
            'item_count' => Item::count(),
            'post_statistics' => Post::select(DB::raw('count(id) as count'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get(),
        ];

        return ResponseHelper::select($statistics);
    }
}
