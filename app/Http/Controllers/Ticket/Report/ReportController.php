<?php

namespace App\Http\Controllers\Ticket\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReportRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $report = [
            'ticket_id' => $data['ticket'],
            'content' => $data['content'],
            'reportable_id' => Auth::user()->id,
            'reportable_type' => Auth::user()::class
        ];
        Report::create($report);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Report $report
     * @return Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Report $report
     * @return Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReportRequest $request
     * @param Report $report
     * @return Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }


}
