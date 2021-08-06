@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px">
            <!-- login -->
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">User Payment History</h1>
                    <div class="report-container">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Invoice ID
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        {{ $purchase->created_at }}
                                    </td>
                                    <td>
                                        {{ $purchase->invoice_id }}
                                    </td>
                                    <td>
                                        S$ {{ $purchase->amount }}
                                    </td>
                                    <td>
                                        {{ $purchase->desc }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="pagination"> {{ $purchases->links() }} </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
