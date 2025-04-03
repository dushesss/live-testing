<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveTest;
use Illuminate\Http\Request;

class LiveTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LiveTest $liveTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiveTest $liveTest)
    {
        $this->authorize('update', $liveTest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveTest $liveTest)
    {
        //
    }
}
