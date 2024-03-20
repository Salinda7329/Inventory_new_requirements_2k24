@extends('PurchasingManager.PM-layout')

@section('title', 'View Items Under Categories | Inventory | SIBA Campus')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        <div style="color: blue">
                            Category Name - {{ $category->category_name }}
                        </div>
                    </div>

                    {{-- {{ dd($productData) }} --}}

                    <div class="card-body">
                        <table id="all_data" class="data-table">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Item Name</th>
                                    <th>Balance</th>
                                    <th>Item Price</th>
                                    <th>Value</th>
                                    <th>Limit</th>
                                    <th>Created By</th>
                                    <th>Created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <?php $value = $item->item_price * $item->items_remaining; ?>
                                <?php $limitStyle = ($item->items_remaining <= $item->lower_limit) ? 'color: red;' : ''; ?>
                                <tr>
                                    <td style="{{ $limitStyle }}">{{ $item->item_ref }}</td>
                                    <td style="{{ $limitStyle }}">{{ $item->item_name }}</td>
                                    <td style="{{ $limitStyle }}">{{ $item->items_remaining }}</td>
                                    <td>{{ $item->item_price }}</td>
                                    <td>{{ $value }}</td>
                                    <td style="{{ $limitStyle }}">{{ $item->lower_limit }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                        <script>
                            $(document).ready(function() {
                                // //Make table a data table
                                $('#all_data').DataTable({
                                    order: [
                                        [0, 'desc']
                                    ]
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
