<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {

            return view('clients.index');

            // return view('clients.index', [
            //         'clients' => User::role('client')->where(['active'=>1])->paginate(15),
            //     ]
            // );
        } else {
            return redirect()->route('orders.index')->withStatus(__('No Access'));
        }
    }


    public function getClients(){

        // $data = User::select(['id', 'name','email','created_at','active'])->role('client')->where(['active'=>1]);

        $query = User::query();
        $query = $query->where(['active' => 1]);
        $query = $query->role('client');

        // add more wheres as needed
        $data = $query->get();


        return Datatables::of($data)->editColumn('created_at', function ($request) {
                return $request->created_at->toDayDateTimeString();
            })->make(true);

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
    public function edit(User $client)
    {
        if (auth()->user()->hasRole('admin')) {
            return view('clients.edit', compact('client'));
        } else {
            return redirect()->route('orders.index')->withStatus(__('No Access'));
        }
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
    public function destroy(User $client)
    {
        $client->active = 0;
        $client->save();

        dd($client);

        return redirect()->route('clients.index')->withStatus(__('Client successfully deleted.'));
    }
}
