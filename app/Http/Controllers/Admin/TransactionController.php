<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{

    public function index()
    {
        if (request()->ajax())
        {
            $query = Transaction::with(['user']);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="'. route('transaction.edit', $item->id) .'" class="dropdown-item">Edit</a>
                                    <form action="'. route('transaction.destroy', $item->id) .'" method="post">
                                    '. csrf_field().''. method_field('delete') .'
                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.transaction.index');
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

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, $id)
    {
        Transaction::findOrFail($id)->update($request->all());

        return redirect()->route('transaction.index');
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->back();
    }
}
