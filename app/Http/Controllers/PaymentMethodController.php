<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pm = PaymentMethod::where('user_id', Auth()->user()->id )->paginate(10);

        return view('payment_methods.index', ['pm' => $pm]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $pm = New PaymentMethod();

        $pm->user_id = $request->user_id;
        $pm->name = $request->name;
        $pm->desc = $request->desc;
        $pm->status = 1;
        $pm->type = $request->type;
        $pm->save();

        return redirect()->route('paymentMethod.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {

        $pm = PaymentMethod::find($paymentMethod->id);


        return view('payment_methods.show', ['pm' => $pm]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {

         $pm = PaymentMethod::find($paymentMethod->id);

        return view('payment_methods.edit', ['pm' => $pm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {

        $pm = PaymentMethod::find($paymentMethod->id);

        $pm->user_id = $request->user_id;
        $pm->name = $request->name;
        $pm->desc = $request->desc;
        $pm->status = 1;
        $pm->type = $request->type;
        $pm->update();

        return redirect()->route('paymentMethod.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {

        $pm = PaymentMethod::find($paymentMethod->id);
        $pm->status = 0;
        $pm->save();


        return redirect()->route('paymentMethod.index');
    }
}
