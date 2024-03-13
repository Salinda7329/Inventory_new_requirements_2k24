@extends('PurchasingManager.PM-layout')

@section('title', 'View Product Levels | Inventory | SIBA Campus')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        Products and Levels
                    </div>

                    <div class="card-body">
                        <table id="all_product_limits_data" class="data-table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Available item Count</th>
                                    <th>Working item Count</th>
                                    <th>Damaged Item Count</th>
                                    <th>Lower Limit</th>
                                    <th>View Items Under Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData as $data)
                                    <tr class="{{ $data['is_at_lower_limit'] ? 'row-at-lower-limit' : '' }}">
                                        <td>{{ $data['product_id'] }}</td>
                                        <td>{{ $data['product_name'] }}</td>
                                        <td>{{ $data['category'] }}</td>
                                        <td>{{ $data['availableItemCount'] }}</td>
                                        <td>{{ $data['balance'] }}</td>
                                        <td>{{ $data['damaged_item_count'] }}</td>
                                        <td>{{ $data['lower_limit'] }}</td>
                                        <td><a href="/pm/ViewItemsUnderProduct/{{ $data['product_id'] }}">View</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <script>
                        $(document).ready(function() {
                            // //Make table a data table
                            $('#all_product_limits_data').DataTable({

                                // Enable horizontal scrolling
                                // scrollX: true
                            });

                        });
                    </script>

                    <style>
                        .row-at-lower-limit {
                            /* Example highlight color */
                            color: rgb(226, 27, 27);
                            /* Example text color */
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>
@endsection
