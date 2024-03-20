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
                        <!-- Button to trigger the Excel export -->
                        <button type="button" class="btn btn-success float-end" id="exportExcel">Export to Excel</button>
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
                                    <?php $limitStyle = $item->items_remaining <= $item->lower_limit ? 'color: red;' : ''; ?>
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

    <!-- Include the necessary dependencies for exporting Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add click event listener to the export button
            $('#exportExcel').click(function() {

                // Get the category name
                var categoryName = "{{ $category->category_name }}";

                // Disable DataTables pagination temporarily
                var dataTable = $('#all_data').DataTable();
                var originalPageLength = dataTable.page.len(); // Store the original page length
                dataTable.page.len(-1).draw();

                // Get the HTML content of the table
                var htmlTable = document.getElementById('all_data').outerHTML;

                // Convert the HTML table to a workbook
                var workbook = XLSX.utils.table_to_book(document.getElementById('all_data'));

                // Generate a binary string from the workbook
                var binaryString = XLSX.write(workbook, {
                    bookType: 'xlsx',
                    type: 'binary'
                });

                // Convert the binary string to a Blob
                var blob = new Blob([s2ab(binaryString)], {
                    type: 'application/octet-stream'
                });

                // Save the Blob as an Excel file
                saveAs(blob,categoryName + '_items_list.xlsx');

                // Re-enable DataTables pagination after export
                dataTable.page.len(originalPageLength).draw();
            });
        });

        // Utility function to convert a string to an ArrayBuffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }
    </script>
@endsection
