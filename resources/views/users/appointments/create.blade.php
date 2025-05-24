@extends('users.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('user.dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                    </span>
                    <img src="{{asset('icons/icons8-veterinarian-100.png')}}" alt="" style="width: 50px;">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">VCMS</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('home') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->

                <li class="menu-item {{$ActiveTab === 'appointments' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-regular fa-calendar"></i>
                        <div data-i18n="Layouts">Appointments</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.maintenance') }}" class="menu-link">
                                <div data-i18n="Without menu">Appointment Calendar</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $SubActiveTab === 'userAppointments' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Book An Appointments</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.appointments.view') }}" class="menu-link">
                                <div data-i18n="Without navbar">View Appointments</div>
                            </a>
                        </li>
                    </ul>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-shield-dog"></i>
                        <div data-i18n="Layouts">My Pets</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.pets.view', ['id' => auth()->user()->id]) }}" class="menu-link">
                                <div data-i18n="Without navbar">View My Pets</div>
                            </a>
                        </li>

                    </ul>
                </li>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Accounts</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="Account Settings">Account Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.accounts.show') }}" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Notifications">Settings</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.accounts.edit') }}" class="menu-link">
                                <div data-i18n="Notifications">Update Account</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Misc</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div data-i18n="Misc">Misc</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.logs.logs') }}" class="menu-link">
                                <div data-i18n="Under Maintenance">Logs</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <!-- <i class="bx bx-search fs-4 lh-0"></i>
              <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                aria-label="Search..." /> -->
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <!-- <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> -->

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                                        class="w-px-120  h-px-120 rounded-circle" />
                                </div>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                                                        class="w-px-120 h-px-120 rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ optional(Auth::user())->name }}
                                                </span>
                                                <small class="text-muted">{{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.accounts.edit', ['id' => auth()->user()->id]) }}">
                                        <i class="menu-icon bx bx-edit-alt"></i>
                                        <span class="align-middle">Update Accounts</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.logs.logs') }}">
                                        <i class="menu-icon tf-icons bx bx-file"></i>
                                        <span class="align-middle">Logs</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle" style="color:#ff6347;">Log Out</span>
                                    </a>
                                    <form action="{{route('logout')}}" method="post" id="logout-form">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Book/</span> Appointment</h4>
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link bg-dark text-white" href="javascript:void(0);">
                                <i class="fa-solid fa-calendar-check"></i> Appointments
                            </a>
                        </li>
                    </ul>

                    <!-- Basic Layout -->
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Book an Appointment</h5>
                                    <small class="text-muted float-end">Fill in the details to book</small>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('user.appointments.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif


                                        <!-- Name of the pet owner -->
                                        <div class="mb-3">
                                            <label class="form-label" for="pet-name">Owner's Name</label>
                                            <input type="text" class="form-control" id="pet-name" name="owner_name" placeholder="Enter owner name" required />
                                        </div>


                                        <!-- Name of the pets -->
                                        <div class="mb-3">
                                            <label class="form-label" for="pet-name">Name of Pets</label>
                                            <input type="text" class="form-control" id="pet-name" name="pet_name" placeholder="Enter pet name" required />
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="mb-3">
                                            <label class="form-label" for="pet-name">Contact Number</label>
                                            <input type="number" class="form-control" id="contact-number" name="contact_number" required maxlength="11" oninput="if(this.value.length > 11) this.value = this.value.slice(0,11);" placeholder="Enter contact number" required />
                                        </div>

                                        <!-- Breed of Pets -->
                                        <div class="mb-3">
                                            <label class="form-label" for="pet-breed">Breed of Pets</label>
                                            <select class="form-control" id="pet-breed" name="pet_breed" required>
                                                <option value="" disabled selected>Select breed</option>
                                                <option value="Aspins">Aspins</option>
                                                <option value="Shih Tzu">Shih Tzu</option>
                                                <option value="Labrador Retriever">Labrador Retriever</option>
                                                <option value="Golden Retriever">Golden Retriever</option>
                                                <option value="Poodle">Poodle</option>
                                                <option value="Persian Cat">Persian Cat</option>
                                                <option value="Siamese Cat">Siamese Cat</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <!-- Appointment Date -->
                                        <div class="mb-3">
                                            <label class="form-label" for="appointment-date">Appointment Date</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="appointment-date"
                                                name="appointment_date"
                                                required
                                                min="{{ \Carbon\Carbon::now()->toDateString() }}" />
                                        </div>


                                        <!-- Upload Document -->
                                        <div class="mb-3">
                                            <label class="form-label" for="upload-document">Upload the medical Records</label>
                                            <input type="file" class="form-control" id="upload-document" name="upload_document" />
                                        </div>

                                        <!-- Pets Picture -->
                                        <div class="mb-3">
                                            <label class="form-label" for="upload-document">Upload your Pet's Picture</label>
                                            <input type="file" class="form-control" id="upload-document" name="pets_picture" />
                                        </div>

                                        <!-- Reason for Appointment -->
                                        <div class="mb-3">
                                            <label class="form-label" for="reason">Reason for Appointment</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="3"
                                                placeholder="Explain the reason for your visit" required></textarea>
                                        </div>



                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Book Appointment</button>
                                    </form>

                                    <!-- JavaScript to handle the dynamic image change -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span class="fw-bold" style="color: #ff6347;">Coder</span></a>
                        </div>
                        <div>
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

                            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                target="_blank" class="footer-link me-4">Documentation</a>

                            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                                class="footer-link me-4">Support</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
@endsection