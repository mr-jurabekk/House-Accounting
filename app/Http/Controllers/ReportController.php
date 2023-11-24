<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('update-post', auth()->user())) {
            abort(401);
        }

        $in = Report::where('type_id', 1)->sum('sum');
        $out = Report::where('type_id', 2)->sum('sum');

        $records = Report::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->get();

        $summa = 0;
        $summa2 = 0;
        foreach ($records as $record) {
            if ($record->type_id == 1) {
                $summa += $record->sum;
            } else {
                $summa2 += $record->sum;
            }
        }

        return view('show')->with([
            'reports' => Report::latest()->get(),
            'records' => $records,
            'salary' => $in,
            'expenses' => $out,
            'debit' => $summa,
            'credit' => $summa2,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $my_salary = auth()->user()->reports->where('type_id', 1)->sum('sum');
        $my_exp = auth()->user()->reports->where('type_id', 2)->sum('sum');


        return view('report')->with([
            'categories' => Category::where('type_id', 2)->get(),
            'category2' => Category::where('type_id', 1)->get(),
            'histories' => Report::where('user_id', auth()->user()->id)->latest('date')->get(),
            'child_reports' => Report::where('user_id', '!=', 1)->latest()->get(),

            'my_salary' => $my_salary,
            'my_exp' => $my_exp,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {

        if ($request->time) {
            $time = $request->time;
        }
        $now = Carbon::now();
        Report::create([
            'user_id' => auth()->user()->id,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'sum' => $request->sum,
            'comment' => $request->comment,
            'date' => $time ?? $now,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {

        $report->delete();

        return redirect()->route('reports.index');
    }

    public function delete()
    {
        if (! (new \Illuminate\Auth\Access\Gate)->allows('update-post', auth()->user())) {
            abort(403);
        }

        Report::query()->delete();

        return redirect()->route('reports.index');
    }
}
