<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use DB;
use App\Models\Ligne;
use App\Models\Stop;
use App\Models\Station;
use App\Models\StationLignes;

class VoyageController extends Controller
{

    use GeneralTrait;

     public function index()
     {
          $activebookings = DB::table('lignes')
             ->join('lignes_stations', 'lignes.id', '=', 'lignes_stations.ligne_id')
             ->join('stations', 'stations.id', '=', 'lignes_stations.station_id')
              ->select('lignes.*', 'stations.*','lignes_stations.time')
            ->get();
      $lignes= Ligne::with('voyages')->get();

      return $activebookings;
    


      }

    public function index1()
    {

          $activebookings = DB::table('lignes')
             ->join('lignes_stations', 'lignes.id', '=', 'lignes_stations.ligne_id')
             ->join('stations', 'stations.id', '=', 'lignes_stations.station_id')
             ->select('reservations.*', 'trips.*','links.*')
            ->where('reservations.user_id','=', $userId)
             ->where('reservations.status', 0)
            // ->where(function ($query) {
            //         $query->where('reservations.status', 1)
            //              ->orwhere('reservations.status', 0);
            //    })
            ->get();


        $lat_from = 34.00460453913762;
        $lng_from =  -6.8557453874916146;
        $lat_to = 34.01684197455722;
        $lng_to = -6.8455315354421185;
        $distance = 2;

       
    $data =[];

        $data['query1']= Stop::getByDistance($lat_from, $lng_from,$distance);
          // return  $data['query1'];
         if(empty( $data['query1'])) {
              return $this->returnError('001', 'this trip doesnt exist');
          } 
   return  $data['query1'];
          
          $ids = [];

        //Extract the id's
          foreach( $data['query1'] as $q)
          {
            array_push($ids, $q->id);
          }
// return $query;
           // $data['product'] = Product::where('slug',$slug) -> first(); 
         $ligne = StationLignes::whereIn( 'station_id', $ids)->pluck('ligne_id'); 
         

         //I get the ligne id

           $data['query2'] = Stop::getByDistanceto($lat_to, $lng_to,$distance,$ligne );
          //I get the stop B (destination)
             
 return   $data['query2'] ;
        $trip = Ligne::with('voyages','voyages.driver','voyages.vehicle')->whereIn('id',$ligne)->get();
        return $trip;
            // $resultsto = StationLignes::whereIn( 'station_id', $ids)->where('ligne_id',$results ); 
            //      return  $results;



       // $product_categories_ids =   $query -> lignes ->pluck('id');

         // $relatedOrders =  $station->lignes_stations->pluck($ids);

          // $results = $station->lignes_stations->whereIn( 'id', $ids)->get(); 

            // $results = Ligne::whereIn( 'id', $ids)->lignes_stations->get(); 
   
   

       //    $results = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians(' . $lat_from . ') ) * cos( radians( lat_from ) )
       // * cos( radians( lng_from ) - radians(' . $lng_from . ') )
       // + sin( radians(' . $lat_from .') ) * sin( radians(lat_from) ) ) ) as distance_from ,

       // ( 3959 * acos( cos( radians(' . $lat_to . ') ) * cos( radians( lat_to ) ) * cos( radians( lng_to ) - radians(' . $lng_to . ') )
       // + sin( radians(' . $lat_to .') ) * sin( radians(lat_to) ) ) ) AS distance_to
       //  FROM links  HAVING distance_to < ' . $distance . ' and distance_from < '.$distance.'  ORDER BY distance_to') );




    }


}