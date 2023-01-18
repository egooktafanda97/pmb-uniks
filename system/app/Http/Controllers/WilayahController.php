<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wilayah_provinsi;

class WilayahController extends Controller
{
    public function Wilayah(Request $request)
    {
        try {
            $provinsi_id = null;
            $kabupaten_id = null;
            $kecamatan_id = null;
            $kelurahan_id = null;
            if ($request->provinsi_id) {
                $provinsi_id = $request->provinsi_id;
            } elseif ($request->kabupaten_id) {
                $Query = \App\Models\wilayah_kabupaten::find($request->kabupaten_id);
                $kabupaten_id = $Query->id;
                $provinsi_id = $Query->provinsi_id;
            } elseif ($request->kecamatan_id) {
                $Query = \App\Models\wilayah_kecamatan::find($request->kecamatan_id);
                $QueryKab = \App\Models\wilayah_kabupaten::find($Query->kabupaten_id);
                $kecamatan_id = $Query->id;
                $kabupaten_id = $Query->kabupaten_id;
                $provinsi_id = $QueryKab->provinsi_id;
            } elseif ($request->kelurahan_id) {
                $Query = \App\Models\wilayah_kelurahan::find($request->kelurahan_id);
                $QueryKec = \App\Models\wilayah_kecamatan::find($Query->kecamatan_id);
                $QueryKab = \App\Models\wilayah_kabupaten::find($QueryKec->kabupaten_id);
                $kelurahan_id =  $Query->id;
                $kecamatan_id =  $Query->kecamatan_id;
                $kabupaten_id = $QueryKab->id;
                $provinsi_id = $QueryKab->provinsi_id;
            } else {
                return response()->json([], 404);
            }
            /**
             * .
             * defennisikan kesas
             */

            $model = new wilayah_provinsi();
            /**
             * .
             * keluarkan provinsi
             */
            $result = $model->all();
            /**
             * .
             * jika provinsi sudah di pilih 
             */
            if ($provinsi_id != null) {
                /**
                 * .
                 * Query get Kabupaten 
                 */
                $model = $model->where("id", $provinsi_id)->with("kabupaten")->first();
                /**
                 * .
                 * kelurkan kabulaten
                 */
                $result = $model->kabupaten;
                /**
                 * .
                 * Jika kabupaten sudah dipilih 
                 */
                if ($kabupaten_id != null) {
                    /**
                     * .
                     * Query get kecamatan by id
                     */
                    $model = $model->where("id", $provinsi_id)->with("kabupaten", function ($query) use ($kabupaten_id) {
                        /**
                         * .
                         * ambil kecamatan di dalam nya
                         */
                        return $query->where('id', '=', $kabupaten_id)->with("kecamatan");
                    })->first();
                    /**
                     * .
                     * kelurkan kecamatan
                     */
                    $result = $model->kabupaten[0]->kecamatan;
                    /**
                     * .
                     * jika kecamatan sudah di pilih
                     */
                    if ($kecamatan_id != null) {
                        /**
                         * .
                         * select provinsi
                         */
                        $model = $model->where("id", $provinsi_id)->with("kabupaten", function ($query) use ($kabupaten_id, $kecamatan_id) {
                            /**
                             * .
                             * select kabupaten
                             */
                            return $query->where('id', '=', $kabupaten_id)->with("kecamatan", function ($query) use ($kecamatan_id) {
                                /**
                                 * .
                                 * select kecamatan
                                 */
                                return $query->where('id', '=', $kecamatan_id)->with("kelurahan");
                            });
                        })->first();
                        /**
                         * .
                         * kelurkan kelurahan
                         */
                        $result = $model->kabupaten[0]->kecamatan[0]->kelurahan;
                        /**
                         * .
                         * jika kelurahan di pilih
                         */
                        if ($kelurahan_id != null) {
                            $model = $model->where("id", $provinsi_id)->with("kabupaten", function ($query) use ($kabupaten_id, $kecamatan_id, $kelurahan_id) {
                                /**
                                 * .
                                 * select kabupaten
                                 */
                                return $query->where('id', '=', $kabupaten_id)->with("kecamatan", function ($query) use ($kecamatan_id, $kelurahan_id) {
                                    /**
                                     * .
                                     * select kecamatan
                                     */
                                    return $query->where('id', '=', $kecamatan_id)->with(
                                        "kelurahan",
                                        function ($query) use ($kelurahan_id) {
                                            /**
                                             * .
                                             * select kelurahan
                                             */
                                            return $query->where('id', '=', $kelurahan_id);
                                        }
                                    );
                                });
                            })->first();
                            $result = $model->kabupaten[0]->kecamatan[0]->kelurahan[0];
                        }
                    }
                }
            }
            // if ($kabupaten_id != null) {
            //     $model = $model->whereHas("kabupaten", function ($query) use ($kabupaten_id) {
            //         return $query->where('id_kabupaten', '=', $kabupaten_id);
            //     });
            //     return response()->json($model->get());
            // }
            // $model = $model->get();

            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json([], 404);
        }
    }


    /**
     * .
     * menghilangkan Kab. pada nama kabupaten
     * @return void
     */
    // public function updatekabupaten()
    // {
    //     $up = \App\Models\wilayah_kabupaten::all();
    //     $z = [];
    //     foreach ($up as $key => $value) {
    //         $split = str_replace('Kab. ', '', $value->nama_kabupaten);
    //         // $sp = trim(str_replace('  ', ' ', $split));

    //         $up = \App\Models\wilayah_kabupaten::where("id_kabupaten", $value->id_kabupaten)->update([
    //             "nama_kabupaten" => $split
    //         ]);
    //         array_push($z, \App\Models\wilayah_kabupaten::where("id_kabupaten", $value->id_kabupaten)->first()->nama_kabupaten);
    //     }
    //     dd($z);
    // }
}
