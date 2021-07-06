<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsteroidController extends Controller
{
    public function index()
    {
        return view('daterange');
    }

    public function getAsteroidDetails(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$start_date&end_date=$end_date&api_key=7qGMQV7aEJdoZu5Q1eUYvzGx3yYzV28qTyzThdNN";
        return $this->sendAsteroidAPI($url);
    }

    public function sendAsteroidAPI($url)
    {
        $header =array('Content-Type: application/json','Content-Length: 0');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);      
        $response = curl_exec($ch);
        //$curl_error = curl_error($ch);
        curl_close($ch);
        $data = json_decode($response, true);
     
        if( !empty($data['code']) && $data['code'] == 400 ){
            echo '<h2>'.$data['error_message'].'</h2>';
            exit;
        }
        $data_arr = $data;
        // dd($data_arr);
        $perDayAsteroid = array();

        if(!empty($data_arr)){
            foreach($data_arr['near_earth_objects'] as $dt=>$record){
                //to get count per day
                $perDayAsteroid[$dt] = count($record);
                // dd($perDayAsteroid[$dt]);
                $astDateWise[] = $dt;
                $astDateWiseCount[] = count($record);

                // Fastest Asteroid in km/h (Respective Asteroid ID & its speed)
                foreach($record as $key=>$val){
                    // speed done
                    $asteroidID = $val['id'];
                    $fastAst[$dt][$asteroidID] = $val['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                    // speed done

                    // distance ast
                    $closeAst[$dt][$asteroidID] = $val['close_approach_data'][0]['miss_distance']['kilometers'];
                    // distance done

                    // average min size
                    $averageMinSize[$asteroidID] = $val['estimated_diameter']['kilometers']['estimated_diameter_min'];
                    $averageMaxSize[$asteroidID] = $val['estimated_diameter']['kilometers']['estimated_diameter_max'];
                    // average done            
                }

            }

            foreach($fastAst as $dt=>$val)
            {
                $val_max = max($val);
                $max_key = array_search($val_max, $val);
                // $date_wise_max[$dt][$max_key]= $val_max;
                $date_wise_max[$max_key]= $val_max;
            }
            $final_record = max($date_wise_max);
            $final_record_key = array_search($final_record, $date_wise_max);
            $fastest_ast_id = $final_record_key;
            $fastest_ast_speed = $final_record;

            // End Of Fastest Asteroid

            // Closest Asteroid ID & its distance
            foreach($closeAst as $dt=>$val)
            {
                $val_min = min($val);
                $min_key = array_search($val_min, $val);
                // $date_wise_max[$dt][$max_key]= $val_max;
                $dtwise_min[$min_key]= $val_min;
            }
            // print_r($dtwise_min);
            $closest_min = min($dtwise_min);
            $closest_min_key = array_search($closest_min, $dtwise_min);
            $closest_ast_id = $closest_min_key;
            $closest_ast_distance = $closest_min;
            // End of Closest Asteroid ID & its distance

            // Average Max & Min Asteroid Size
            $avgMinAsteroid = array_sum($averageMinSize)/count($averageMinSize);
            $avgMaxAsteroid = array_sum($averageMaxSize)/count($averageMaxSize);
            // End of Average Max & Min Asteroid Size

            $dataArray['perDayAsteroid'] = $perDayAsteroid;
            $dateWiseAstJson = json_encode($astDateWise);
            $dateWiseRecordAstJson = json_encode($astDateWiseCount);
            // dd($dateWiseAstJson);
            return view('asteroid-chart',compact('dataArray','dateWiseAstJson','dateWiseRecordAstJson','fastest_ast_id','fastest_ast_speed','closest_ast_id','closest_ast_distance','avgMinAsteroid','avgMaxAsteroid'));
        }
    }
}
