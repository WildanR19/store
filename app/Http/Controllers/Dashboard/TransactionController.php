<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.gallery'])
            ->whereHas('product', function ($product) {
                $product->where('user_id', Auth::user()->id);
            })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.gallery'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('user_id', Auth::user()->id);
            })->get();

        return view('pages.dashboard.transaction.index', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details($id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.gallery'])
            ->findOrFail($id);
        return view('pages.dashboard.transaction.details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        TransactionDetail::findOrFail($id)->update($data);

        return redirect()->back();
    }
}
