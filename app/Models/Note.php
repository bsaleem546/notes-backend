<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public static function getData(Request $request, $pagination = true, $perpage = 10)
    {
        $output = [];
        $query = Self::query();

        $dateFrom = $request->filled('date-from') ? $request->input('date-from') : '1999-01-01';
        $dateTo = $request->filled('date-to') ? $request->input('date-to') : now()->addDay()->toDateString();
        if ($dateFrom && $dateTo) {
            $query->whereDate('created_at', '>=', $dateFrom)->whereDate('created_at', '<=', $dateTo);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->input('search') . '%');
                $q->orWhere('title', 'like', '%' . $request->input('search') . '%');
            });
        }

        if ($pagination === false) {
            $output = $query->orderBy('id', 'DESC')->get();
            return $output;
        }

        $output = $query->orderBy('id', 'DESC')->paginate($perpage);

        return $output;
    }
}
