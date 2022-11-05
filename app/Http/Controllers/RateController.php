<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Rate;
class RateController extends Controller
{
    public function showRate($id)
    {
        $trip_id = $id;
        $rate = Rate::where('trip_id',$id)->first();
        return view('user.rate', compact('trip_id', 'rate'));
    }

    public function rating(Request $request)
    {
          $trip = Trip::where('id', $request->trip_id)->first();
          
        //   return $trip;
        if($trip->rate()->exists())
        {
            // ,'','','','','','',''
            $trip->rate()->update([

                'belt'          => $request->belt,
                'upload'        => $request->upload,
                'speed'         => $request->speed,
                'driving'       => $request->driving,
                'appearance'    => $request->appearance,
                'clean'         => $request->clean,
                'roads'         => $request->roads,
                'welcom'        => $request->welcom



            ]);

            flash()->success("تم تحديث التقييم");
            return back();
        }else
        {

            $rate = Rate::create([

                'belt'          => $request->belt,
                'upload'        => $request->upload,
                'speed'         => $request->speed,
                'driving'       => $request->driving,
                'appearance'    => $request->appearance,
                'clean'         => $request->clean,
                'roads'         => $request->roads,
                'welcom'        => $request->welcom,
                'trip_id'       => $request->trip_id

            ]);

            $trip->update([

                'rate_id' => $rate->id
            ]);


            flash()->success("تم وضع التقييم");
            return back();
        }



    }
}