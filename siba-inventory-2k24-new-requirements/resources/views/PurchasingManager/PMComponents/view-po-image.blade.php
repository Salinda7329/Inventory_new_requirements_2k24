@extends('PurchasingManager.PM-layout')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-header">
                        <h1>Purchasing Order View</h1>
                    </div>
                    <div class="card-body">
                        {{-- <iframe src="/assets/{{$porder->image}}"></iframe> --}}
                        <iframe src="{{ asset('storage/assets/po_images/' . $porder->image) }}" style="max-width: 100%; max-height: 100%; width: 100%; height: 1500px;"></iframe>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
