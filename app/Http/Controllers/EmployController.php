<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;
use App\City;
use App\Events\CallWaiter;
use App\Extras;
use App\Hours;
use App\Imports\RestoImport;
use App\Items;
use App\Models\LocalMenu;
use App\Models\Options;
use App\Notifications\RestaurantCreated;
use App\Notifications\WelcomeNotification;
use App\Plans;
use App\Restorant;
use App\Tables;
use App\User;
use Artisan;
use Carbon\Carbon;
use DB;
use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
//use Intervention\Image\Image;
use Image;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;


class EmployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
      public function register()
    {
        return view('restorants.employes');
    }
     public function showEmployes()
    {
      
              if (auth()->user()->hasRole('owner')) {
               
               $restaurant = auth()->user()->restorant;
 
       
                $drivers = User::role('driver')->where(['restorant_id'=>$restaurant->id])->get();
    
              if ($drivers) {
                  
                        return view('restorants.employes_list', [
                            
                            'drivers'=>$drivers,
                            'fields'=>[['class'=>'col-12', 'classselect'=>'noselecttwo', 'ftype'=>'select', 'name'=>'Driver', 'id'=>'driver', 'placeholder'=>'Assign Driver', 'required'=>true]],
                          
                            'parameters'=>count($_GET) != 0,
                        ]);


              }
              else {
            return redirect()->route('driver.employ.register')->withStatus(__('No Access'));
           }



        } else {
            return redirect()->route('/')->withStatus(__('No Access'));
        }
             

   

      

    }

  public function storeRegisterEmployes(Request $request)
    {
        //Validate first
        $theRules = [
            'name' =>['required', 'string', 'max:255'],
        
            'email_owner' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone_owner' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
          
        ];
          

        if (strlen(config('settings.recaptcha_site_key')) > 2) {
            $theRules['g-recaptcha-response'] = 'recaptcha';
        }

        $request->validate($theRules);
       
             $restaurant = auth()->user()->restorant;
              
        //Create the user
        //$generatedPassword = Str::random(10);
        $owner = new User;
        $owner->name = strip_tags($request->name);
        $owner->email = strip_tags($request->email_owner);
        $owner->phone = strip_tags($request->phone_owner) | '';
          $owner->restorant_id = $restaurant->id;
        $owner->active = 1;
       
        $owner->api_token = Str::random(80);

        $owner->password = Hash::make($request->password);
       $owner->save();
   
 
        //Assign role
           $owner->assignRole('driver');


        //Send welcome email

        //welcome notification
        //Create Restorant
  
        // Log::emergency($restaurant);

            //Foodtiger
            return redirect()->route('driver.employ.register')->withStatus(__('notifications_thanks_and_review'));
        
    }

      public function updateStatus($alias, User $driver)
    {
      

     
  $restaurant = auth()->user()->restorant;
        
        //Check access before updating
        /**
         * 1 - Super Admin
         * accepted_by_admin
         * assigned_to_driver
         * rejected_by_admin.
         *
         * 2 - Restaurant
         * accepted_by_restaurant - 3
         * prepared
         * rejected_by_restaurant
         * picked_up
         * delivered
         *
         * 3 - Driver
         * picked_up
         * delivered
         */
        //

   

        //For owner - make sure this is his order
        if (auth()->user()->hasRole('owner')) {
            //This user is owner, but we must check if this is order from his restaurant

            if ($restaurant->id != $driver->restorant_id) {
                abort(403, 'Unauthorized action. You are not owner of this restaurant');
            }
        }

     $driver->active =$alias;
     $driver->save();
        // dd($status_id_to_attach."");

        // if (config('app.isft')) {
        //     if ($status_id_to_attach.'' == '3' || $status_id_to_attach.'' == '5' || $status_id_to_attach.'' == '9') {
        //         $order->client->notify(new OrderNotification($order, $status_id_to_attach));
        //     }

        //     if ($status_id_to_attach.'' == '4') {
        //         $order->driver->notify(new OrderNotification($order, $status_id_to_attach));
        //     }
        // }



       return redirect()->route('driver.employ.show')->withStatus('Estado del empleado cambiado.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
