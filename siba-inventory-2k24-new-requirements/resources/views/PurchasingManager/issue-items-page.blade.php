@extends('PurchasingManager.PM-layout')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            @include('PurchasingManager.PMComponents.Modal-issue-item-from-Stock')
            <br><br>
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        Issuence Table
                    </div>
                    <div class="card-body">
                        <div id="show_all_issue_data"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- @include('PurchasingManager.PMComponents.Modal-EditStock') --}}
@endsection
