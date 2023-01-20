<?php

namespace Modules\V1\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait InformasiPendaftaranController
{
    public function up_status(Request $request, $id)
    {
        try {
            $this->resources->getModel()::query()->update([
                "status" => 'in_active'
            ]);
            $this->resources->getModel()::whereId($id)->update([
                "status" => $request->status
            ]);
            return response()->json([
                "response" => $this->resources->getModel()::find($id),
                "error" => []
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "response" => [],
                "error" => $th->getMessage()
            ], 401);
        }
    }
}
