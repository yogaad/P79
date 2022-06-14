<?php


namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Desc;
use App\Models\Debit;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; 

class PointController extends Controller
{
    public function index(Request $request  )
    {
        $acc_id = array();
        $acc_name=array();
        $points = array(); 
        $dataz = array();
        $trx = Account::query()->get()->toArray(); 
      
        foreach($trx as $v) {
            
            array_push($acc_id , $v['id']);
            array_push($acc_name , $v['name']);
            array_push($points,0);
           
           
        }

        //looping sebanyak array 
        for ($i=0; $i < count($acc_id);$i++){
            $trx = Transaction::query()
                    ->with('account')
                    ->where([['accountId', '=',$acc_id[$i] ],])    
                    ->get()->toArray(); 

              foreach($trx as $v) {
                if ($v['description']== 2 ||$v['description']== 3 ){
                    $poin =  $this->point(intval($v['amount']),$v['description']);
                    //masukin dulu temp 
                    $points[$i]+=$poin;
                }
              }
              
        }
       
        //looping datatable 
        for ($i=0; $i < count($acc_id);$i++){
            $data =  [
                'num' => $i+1,
                'id' => $acc_id[$i],
                'name' => $acc_name[$i],
                'point' => $points[$i],
            ];
            array_push($dataz,$data);
        }
       
        return view('backadmin.point.index')->with([
            'title' => 'List',
            'subtitle' => 'Point',
            'dataz' => $dataz, 
        ]);

    }

    function point($point,$desc){
            //2 = belipulsa , 3 = bayarlistrik
             
            
            //term pulsa
             $it_pulsa1 = 10000;
             $it_pulsa2 = 30000;
             //term listrik
             $it_listrik1 = 50000;
             $it_listrik2 = 100000;
            //kalo pulsa
             if($desc == 2 ){
                //cek kalo lebih dari ketentuan tinggi
                if ($point > $it_pulsa2){
                    $sisa = $point % $it_pulsa2;
                    $point_a = ($sisa/1000)*2;

                    // iterasi 2
                    $point = ($point - $sisa) - $it_pulsa1 ;
                    $point_b = ($point/1000)*1;

                    //hasil
                    $all_point = $point_a+$point_b;

                    return $all_point;
                     
                }
                 //cek kalo lebih dari ketentuan medium
                else if ($point > $it_pulsa1){
                    

                    // iterasi  
                    $point =  $point   - $it_pulsa1 ;
                    $point_b = ($point/1000)*1;

                    //hasil
                    $all_point =  $point_b;
                    return $all_point;
                }
                else{
                    //kecil
                    $all_point = 0;
                    return $all_point;
                }
             }
             //kalo listrik
             else{
              
                if ($point > $it_listrik2){
                    $sisa = $point % $it_listrik2;
                    $point_a = ($sisa/2000)*2;

                    // iterasi 2
                    $point = ($point - $sisa) - $it_listrik1 ;
                    $point_b = ($point/2000)*1;

                    //hasil
                    $all_point = $point_a+$point_b;
                    return $all_point;
                }
                 //cek kalo lebih dari ketentuan medium
                 else if ($point > $it_listrik1){
                    

                    // iterasi  
                    $point =  $point   - $it_listrik1 ;
                    $point_b = ($point/2000)*1;

                    //hasil
                    $all_point =  $point_b;
                    return $all_point;
                }
                else{
                    //kecil
                    $all_point = 0;
                    return $all_point;
                }
             }

    }
}
