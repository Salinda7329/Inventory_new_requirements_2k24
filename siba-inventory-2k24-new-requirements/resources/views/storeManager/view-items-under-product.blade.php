@extends('storeManager.sm-layout')

@section('title', 'View Product Levels | Inventory | SIBA Campus')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        <div style="color: blue">
                            Product Name - {{ $product->product_name }}
                        </div>
                        <div style="color: blue">
                            Product ID - {{ $product->id }}
                        </div>
                    </div>

                    {{-- {{ dd($productData) }} --}}

                    <div class="card-body">
                        <table id="all_data" class="data-table">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Condition</th>
                                    <th>Availability</th>
                                    <th>Inserted_at</th>
                                    <th>Updated_at</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td style="color: {{ $item->condition == 1 ? 'green' : 'red' }}">
                                            {{ $item->condition == 1 ? 'Working' : 'Damaged' }}
                                        </td>
                                        <td style="color: {{ $item->availability == 1 ? 'green' : 'red' }}">
                                            {{ $item->availability == 1 ? 'Available' : 'Not Available' }}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td
                                            style="color:
                                            @if ($item->isActive == 1) green
                                            @elseif($item->isActive == 2)
                                                red
                                            @elseif($item->isActive == 3)
                                                gray @endif">
                                            @if ($item->isActive == 1)
                                                Active
                                            @elseif($item->isActive == 2)
                                                Deactivated
                                            @elseif($item->status == 3)
                                                Deleted
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <script>
                            $(document).ready(function() {
                                // //Make table a data table
                                $('#all_data').DataTable({
                                    order: [[0, 'desc']]
                                    // Enable horizontal scrolling
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
