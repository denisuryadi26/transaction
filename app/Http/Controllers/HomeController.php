<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\User;
use App\Transaction;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::inRandomOrder()->paginate(10);
        $category = Category::inRandomOrder()->paginate(10);
        $users = User::all();
        $rolesCount = Role::count();
        // $totaltransaksi = Transaction::all();
        // $totaltransaksi = DB::raw('sum(total)')->get();
        $totalpendapatan = DB::table('transactions')->sum('total');
        $totaltransaksi = Transaction::count();
        return view('home', compact('product', 'category', 'users', 'rolesCount', 'totalpendapatan', 'totaltransaksi'));
    }
}
