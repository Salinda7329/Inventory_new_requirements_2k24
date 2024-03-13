
{{-- meka uses lage profile update karana aka mekedi onim user knkt methanat awith profile aka edit karagann plwn wenn hadann  --}}

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <h5 class="card-header">Update profile</h5>
                <div class="card-body">
                    <div class="row flex-lg-nowrap">
                        <div class="col">
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="e-profile">
                                                <div class="row">
                                                    <div class="col-12 col-sm-auto mb-3">
                                                        <div class="mx-auto" style="width: 140px;">
                                                            <div class="d-flex justify-content-center align-items-center rounded"
                                                                style="height: 140px; background-color: rgb(233, 236, 239);">
                                                                <span
                                                                    style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Departmant User</h4>
                                                            <p class="mb-0">Nimal</p>
                                                            <div class="text-muted">
                                                            </div>
                                                            <div class="mt-2">
                                                                <button class="btn btn-primary" type="button" onclick="document.getElementById('fileInput').click();">
                                                                    <i class="fa fa-fw fa-camera"></i>
                                                                    <span>Change Photo</span>
                                                                </button>
                                                                <input type="file" id="fileInput" style="display:none;" accept="image/*" onchange="displayImagePreview(this)">
                                                            </div>
                                                        </div>
                                                        <div class="text-center text-sm-right">
                                                            <div class="text-muted"><small>Joined 09 Dec 2023</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item"><a href class="active nav-link">Settings</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content pt-3">
                                                    <div class="tab-pane active">
                                                        <form class="form" novalidate>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>First name</label>
                                                                                <input class="form-control"
                                                                                    type="text" name="fname"
                                                                                    placeholder="John Smith"
                                                                                    value="John Smith">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>Last name</label>
                                                                                <input class="form-control"
                                                                                    type="text" name="lname"
                                                                                    placeholder="johnny.s"
                                                                                    value="johnny.s">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>Email</label>
                                                                                <input class="form-control"
                                                                                    type="text"
                                                                                    placeholder="user@siba.edu.lk">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>NIC</label>
                                                                                <input class="form-control"
                                                                                    type="text" name="nic"
                                                                                    placeholder="**********V">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>Epf Number</label>
                                                                                <input class="form-control"
                                                                                    type="text" name="epf"
                                                                                    placeholder="s/**/******">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="departmentDropdown" class="form-label">Choose Department</label>
                                                                        <select class="form-select" id="departmentDropdown">
                                                                          <option value="it">I.T</option>
                                                                          <option value="management">Management</option>
                                                                          <option value="dancing">Dancing</option>
                                                                          <option value="english">English</option>
                                                                          <option value="buddhist">Buddhist & Pali</option>
                                                                        </select>
                                                                      </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>User Name</label>
                                                                                <input class="form-control"
                                                                                    type="text" name="uname"
                                                                                    placeholder="nimal01">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 mb-3">
                                                                    <div class="mb-2"><b>Change Password</b></div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>Current Password</label>
                                                                                <input class="form-control"
                                                                                    type="password"
                                                                                    placeholder="••••••">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="co mb-3">
                                                                            <div class="form-group">
                                                                                <label>New Password</label>
                                                                                <input class="form-control"
                                                                                    type="password"
                                                                                    placeholder="••••••">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <div class="form-group">
                                                                                <label>Confirm <span
                                                                                        class="d-none d-xl-inline">Password</span></label>
                                                                                <input class="form-control"
                                                                                    type="password"
                                                                                    placeholder="••••••">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col d-flex justify-content-end">
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="px-xl-3">
                                                <button class="btn btn-block btn-secondary">
                                                    <i class="fa fa-sign-out"></i>
                                                    <span>Logout</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title font-weight-bold">Support</h6>
                                            <p class="card-text">Is any problem .</p>
                                            <button type="button" class="btn btn-primary">Contact Us</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
