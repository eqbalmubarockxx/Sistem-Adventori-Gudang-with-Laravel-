<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['product', 'user'])->latest()->get();
        $products = Product::all(); // Tambahkan ini untuk keperluan modal edit
        return view('transactions.index', compact('transactions', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($request->type === 'out') {
            if ($product->stock < $request->quantity) {
                return back()
                    ->withInput()
                    ->with('error', "Stok tidak mencukupi. Stok tersedia: {$product->stock}");
            }
        }

        $transaction = new Transaction($request->all());
        $transaction->user_id = Auth::id();
        $transaction->transaction_code = 'TRX-' . strtoupper($request->type) . '-' . time();
        
        DB::beginTransaction();
        try {
            $transaction->save();

            // Update stock
            if ($request->type === 'in') {
                $product->stock += $request->quantity;
            } else {
                $product->stock -= $request->quantity;
            }
            $product->save();
            
            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memproses transaksi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Reverse previous stock update
        $oldProduct = Product::findOrFail($transaction->product_id);
        if ($transaction->type === 'in') {
            $oldProduct->stock -= $transaction->quantity;
        } else {
            $oldProduct->stock += $transaction->quantity;
        }
        $oldProduct->save();

        // Update transaction
        $transaction->update($request->all());

        // Update new stock
        $newProduct = Product::findOrFail($request->product_id);
        if ($request->type === 'in') {
            $newProduct->stock += $request->quantity;
        } else {
            $newProduct->stock -= $request->quantity;
        }
        $newProduct->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Reverse stock update
        $product = Product::findOrFail($transaction->product_id);
        if ($transaction->type === 'in') {
            $product->stock -= $transaction->quantity;
        } else {
            $product->stock += $transaction->quantity;
        }
        $product->save();

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
