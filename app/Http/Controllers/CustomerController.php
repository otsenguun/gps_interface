<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\User;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $s = $request->s;

        $customers = Customers::orderBy('id','desc')->search($s)->paginate(100);

        return view('pages.customers.list',compact('customers','start_date','end_date','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customer = new Customers;
        $customer->name = $request->name;
        $customer->re_number = $request->re_number;
        $customer->acount_number = $request->acount_number;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('Customer.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customers::find($id);
        return view('pages.customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customers::find($id);
        return view('pages.customers.edit',compact('customer'));
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
        $customer = Customers::find($id);
        $customer->name = $request->name;
        $customer->re_number = $request->re_number;
        $customer->acount_number = $request->acount_number;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('Customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customers::find($id);
        $customer->destroy();
        return redirect()->route('Customer.index');

    }

    public function createUser($id)
    {
        $customer = Customers::find($id);
        return view('pages.customers.customer_user',compact('customer'));
    }

    public function storeUser(Request $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->org_id = $request->org_id;
        $user->password = Hash::make($request->password);
        $user->type = 1;
        $user->save();

        return redirect()->route('User.index');
    }

}
