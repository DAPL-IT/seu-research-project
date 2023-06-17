<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RentClassification;
use App\Models\RentAd;
use Illuminate\Http\Request;
use Phpml\ModelManager;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    private $LR_PATH = 'ml_model/linear_regression';
    private $KNN_PATH = 'ml_model/k_nearest_neighbour';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'square_feet' => 'required|integer',
            'area_id' => 'required',
        ]);

        if($validator->fails()){
            $response = ['validation' => $validator->errors()];
            return response()->json($response, 422);
        }

        $rooms = $request->rooms;
        $bathrooms = $request->bathrooms;
        $square_feet = $request->square_feet;
        $area_id = $request->area_id;

        // //then we will predict the price range make a DB query
        $predicted_range = $this->getPredictedRange($rooms, $bathrooms, $square_feet, $area_id)['predicted_range'];

        $min_price = $predicted_range['from'];
        $max_price = $predicted_range['to'];
        $suggested_houses = RentAd::whereBetween('price', [$min_price, $max_price])->where('area_id', $area_id)
        ->orderBy('id', 'desc')
        ->with('rent_type', 'area', 'poster')->paginate(27);

        return response()->json(['ads' => $suggested_houses], 200);

    }

    private function getPredictedRange($rooms, $bathrooms, $square_feet, $area_id){
        $modelManager = new ModelManager();
        $linear_regression_model = $modelManager->restoreFromFile($this->LR_PATH);
        $knn_model = $modelManager->restoreFromFile($this->KNN_PATH);

        $lr_predicted_price = abs(intval(round($linear_regression_model->predict([
            $rooms,
            $bathrooms,
            $square_feet,
            $area_id]))));

        $predicted_knn_classifiers = $knn_model->predict([
            $rooms,
            $bathrooms,
            $square_feet,
            $area_id,
            $lr_predicted_price]);

        $predicted_classifier_price_ranges = $this->getPredictedClassifierPriceRanges($predicted_knn_classifiers, $this->priceRange());

        $closest_range = $this->getClosestPriceRangeFromPredictedClassifiers($predicted_classifier_price_ranges, $lr_predicted_price);

        $final_price_range = $this->calculateFinalPriceRange($closest_range, $lr_predicted_price);

        return [
            'predicted_price '=>$lr_predicted_price,
            'predicted_range' => [
                'from'=>$final_price_range['from'],
                'to'=>$final_price_range['to']
            ]
        ];
    }

    private function priceRange(){
        // $rentClassificationRanges = RentClassification::all();
        // $arr = [];

        // foreach($rentClassificationRanges as $range){
        //     $arr[ $range->slug]=['from'=> $range->from, 'to'=>$range->to];
        // }

        $data = [
            'low' => ['from' => 0, 'to' => 5000],
            'low-mid' => ['from' => 5001, 'to' => 8000],
            'low-high' => ['from' => 8001, 'to' => 12000],
            'mid-low' => ['from' => 12001, 'to' => 15000],
            'mid' => ['from' => 15001, 'to' => 20000],
            'mid-high' => ['from' => 20001, 'to' => 25000],
            'high-low' => ['from' => 25001, 'to' => 35000],
            'high-mid' => ['from' => 35001, 'to' => 50000],
            'high' => ['from' => 50001, 'to' => 100000],
        ];

        return $data;
    }

    private function getPredictedClassifierPriceRanges($predicted_knn_classifiers, $price_ranges){
        $predicted_classifier_price_ranges = [];
        foreach(array_keys($predicted_knn_classifiers) as $key){
            if(array_key_exists($key, $price_ranges)){
                $predicted_classifier_price_ranges[$key] =  [
                        'from' => $price_ranges[$key]['from'],
                        'to' => $price_ranges[$key]['to']
                    ];
            }
        }
        return $predicted_classifier_price_ranges;
    }

    private function getClosestPriceRangeFromPredictedClassifiers(
        $predicted_classifier_price_ranges,
        $predicted_price)
        {
            $min_distance = PHP_INT_MAX;
            $closest = null;

            foreach($predicted_classifier_price_ranges as $key=>$range){
                $distance = 0;
                if($predicted_price < $range['from']){
                    $distance = $range['from'] - $predicted_price;
                }
                else if($predicted_price > $range['to']){
                    $distance = $predicted_price - $range['to'];
                }
                if($distance < $min_distance){
                    $min_distance = $distance;
                    $closest = $range;
                }
            }
            return $closest;
    }

    private function calculateFinalPriceRange($closest, $predicted_price){
            $from = $closest['from'];
            $to   = $closest['to'];

            if(!($predicted_price >= $from && $predicted_price <= $to)){
                $range_diff = $to - $from;
                $from_diff = (($from - $predicted_price + 1) >= $range_diff) ? true : false;
                $to_diff = (($predicted_price - $to + 1) >= $range_diff) ? true : false;

                if($predicted_price < $from && $from_diff){
                    $to = $from;
                    $from = $predicted_price;
                }
                else if($predicted_price > $to && $to_diff){
                    $from = $to;
                    $to = $predicted_price;
                }
                else if($predicted_price < $from){
                    $from = $from - ($from-$predicted_price);
                }
                else if($predicted_price > $from){
                    $to = $to + ($predicted_price - $to);
                }
            }

            return [
                'from' => $from,
                'to' => $to
            ];
    }

}

