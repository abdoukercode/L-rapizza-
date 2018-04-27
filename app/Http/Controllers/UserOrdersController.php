<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\PizzaSize;
use App\Topping;

class UserOrdersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sizes = PizzaSize::all();
        
        $user = auth()->user();
        $orders = Order::with('status')->where('user_id', $user->id)->orderBy('id', 'desc')->get();
//dd($orders);
        return view('index', compact('user', 'orders','sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $sizes = PizzaSize::all();
       $toppings = Topping::all();
       //dd($toppings) ;
        return view('create', compact('sizes','toppings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'size' => 'required',
        ]);

        //dd( $request->all());

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'size' => $request->size,
            'toppings' => implode(', ', $request->toppings),
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('user.orders.show', $order)->with('message', 'Order received!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('show', compact('order'));
    }
}
