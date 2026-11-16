<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Delegasikan exportXlsx ke OperasionalController
     */
    public function exportXlsx(Request $request)
    {
        return app(OperasionalController::class)->exportXlsx($request);
    }
}
