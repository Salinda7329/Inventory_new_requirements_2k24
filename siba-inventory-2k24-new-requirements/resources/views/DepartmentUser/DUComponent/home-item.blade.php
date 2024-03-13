
    <style>
       body {
        margin: 0;
        background-color: #f8f7f7;
    }

    .form-card {
        position: relative;
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
        border: none;
        border-radius: 2%;
    }

    .form-card:hover {
        transform: scale(1.1);
    }

    .card-img-top {
        max-height: 150px;
        object-fit: contain;
        object-position: center center;
        margin-top: 60px;
    }

    .card-text {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        text-align: center;
        padding: 10px;
        color: #fff;
        font-weight: bold;
        background: linear-gradient(to bottom, #07c8f9, #0d41e1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        display: block;
        text-decoration: none;
    }

    </style>

    <!-- Navbar -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Human Resource</div>
                    <img src="{{ asset('img/D.U.Dashbord/hr.png') }}" class="card-img-top" alt="Image 1">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Finance</div>
                    <img src="{{ asset('img/D.U.Dashbord/account.png') }}" class="card-img-top" alt="Image 2">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Enventory</div>
                    <img src="{{ asset('img/D.U.Dashbord/store.png') }}" class="card-img-top" alt="Image 3">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Human Resource</div>
                    <img src="{{ asset('img/D.U.Dashbord/hr.png') }}" class="card-img-top" alt="Image 4">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Accounts</div>
                    <img src="{{ asset('img/D.U.Dashbord/account.png') }}" class="card-img-top" alt="Image 5">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Layouts</div>
                    <img src="{{ asset('img/D.U.Dashbord/layout.jpg') }}" class="card-img-top" alt="Image 6">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="login.html" class="card form-card">
                    <div class="card-text">Stock</div>
                    <img src="{{ asset('img/D.U.Dashbord/store.png') }}" class="card-img-top" alt="Image 7">
                    <div class="card-body">
                        <form></form>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>
