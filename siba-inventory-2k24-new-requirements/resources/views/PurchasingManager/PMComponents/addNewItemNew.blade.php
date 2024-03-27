{{-- <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('PurchasingManager.PMComponents.Modal-addNewItemNew')
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Items
                </div>
                <div class="card-body">
                    <div id="show_all_item_data"></div>
                </div>
            </div>

        </div>
    </div>
</div> --}}
@include('PurchasingManager.PMComponents.Modal-EditItemNew')


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('PurchasingManager.PMComponents.Modal-addNewItemNew')
        <br><br>
        <div class="authentication-inner">
            <div class="card">
                <div class="card-header">
                    Store Items List Table <i class='bx bxs-info-square' title="This table shows the existing Item Names in the Store."></i>
                    <!-- Button to trigger the Excel export -->
                    <button type="button" class="btn btn-success float-end" id="exportExcel" title="Export Store Items List Table to an Excel Sheet">Export to Excel</button>
                </div>
                <div class="card-body">
                    <div id="show_all_item_data"></div>
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
        $('#exportExcel').click(function() { // Corrected ID here
            // Disable DataTables pagination temporarily
            var dataTable = $('#all_item_data').DataTable();
            dataTable.page.len(-1).draw();
            // Get the HTML content of the table inside show_all_item_data div
            var htmlTable = document.getElementById('show_all_item_data').outerHTML;

            // Convert the HTML table to a workbook
            var workbook = XLSX.utils.table_to_book(document.getElementById('show_all_item_data'));

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
            saveAs(blob, 'items_list.xlsx');

            // Re-enable DataTables pagination after export
            dataTable.page.len(10).draw(); // Change 10 to your desired page length
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
