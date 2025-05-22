@extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
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
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-paw"></i>
                        <div data-i18n="Layouts">Pets</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item ">
                            <a href="{{ route('admin.pets.show') }}" class="menu-link">
                                <div data-i18n="Without menu">List Pets</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.pets.medical') }}" class="menu-link">
                                <div data-i18n="Without navbar">Medical History</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ $ActiveTab === 'appoinments' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-regular fa-calendar"></i>
                        <div data-i18n="Layouts">Appointments</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Without menu">Appointment Calendar</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $SubActiveTab === 'list' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">View Appointments</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-user"></i>
                        <div data-i18n="Layouts">Owners</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.owners.show', ['id' => auth()->user()->id]) }}" class="menu-link">
                                <div data-i18n="Without navbar">View Owners</div>
                            </a>
                        </li>
                    </ul>
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
                            <a href="{{ route('admin.accounts.show') }}" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Notifications">Settings</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.accounts.edit') }}" class="menu-link">
                                <div data-i18n="Notifications">Update Account</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div data-i18n="Misc">Misc</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="" class="menu-link">
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

                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                                        class="w-px-120 h-px-120 rounded-circle" />
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
                                                <span class="fw-semibold d-block">{{ optional(Auth::user())->name }}</span>
                                                <small class="text-muted">Admin</small>
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
                                    <a class="dropdown-item" href="">
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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Show/</span>Appointments</h4>
                    <!-- Flash message -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Appointmnents</h5>

                        </div>
                        <!-- <div class="card-header d-flex justify-content-between align-items-center">
                            <img id="slsuLogo" src="{{ asset('storage/images/slsu1.png') }}" style="display: none;">
                            <img id="bagongPilipinasLogo" src="{{ asset('storage/images/BagongPilipinasLogo.png') }}"
                                style="display: none;">
                            <img id="picture1FooterLogo" src="{{ asset('storage/images/Picture1.png') }}" style="display: none;">
                            <img id="picture2FooterLogo" src="{{ asset('storage/images/Picture2.png') }}" style="display: none;">
                            <button class="btn btn-sm btn-primary fs-6" id="printBtn">
                                <i class="fa-solid fa-print"></i> Print
                            </button>
                        </div> -->
                        <div class="card-body">
                            <!-- Make table responsive -->
                            <div class="table-responsive">
                                <table class="table table-striped" id="appointmentsTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Owner's Name</th>
                                            <th>Pet's Name</th>
                                            <th>Phone Number</th>
                                            <th>Reason</th>
                                            <th>Breed</th>
                                            <th>Appointment Date</th>
                                            <th>Status</th>
                                            <th>Documents</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($appointments as $index => $appointment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $appointment->owner_name }}</td>
                                            <td>{{ $appointment->pet_name }}</td>
                                            <td>{{ $appointment->contact_number }}</td>
                                            <td>{{ $appointment->reason }}</td>
                                            <td>{{ $appointment->pet_breed }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                                            <td>{{ ucfirst($appointment->status) }}</td>
                                            <td>
                                                @if($appointment->upload_document && file_exists(public_path('storage/' . $appointment->upload_document)))
                                                <img src="{{ asset('storage/' . $appointment->upload_document) }}" alt="Uploaded Document" width="100" height="100">
                                                @else
                                                <span>No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- View Button to trigger Modal -->
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewAppointmentModal{{ $appointment->id }}" title="View Appointment Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="viewAppointmentModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="viewAppointmentModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewAppointmentModalLabel{{ $appointment->id }}">Appointment Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Owner's Name:</label>
                                                                    <input type="text" class="form-control" value="{{ $appointment->owner_name }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Pet's Name:</label>
                                                                    <input type="text" class="form-control" value="{{ $appointment->pet_name }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Phone Number:</label>
                                                                    <input type="text" class="form-control" value="{{ $appointment->contact_number }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Breed:</label>
                                                                    <input type="text" class="form-control" value="{{ $appointment->pet_breed }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Reason:</label>
                                                                    <input type="text" class="form-control" value="{{ $appointment->reason }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Date:</label>
                                                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Status:</label>
                                                                    <input type="text" class="form-control" value="{{ ucfirst($appointment->status) }}" readonly>
                                                                </div>

                                                                @if($appointment->upload_document)
                                                                <div class="mb-2">
                                                                    <label class="form-label fw-bold">Uploaded Document:</label><br>
                                                                    <img src="{{ asset('storage/' . $appointment->upload_document) }}" alt="Document Image" width="100%" class="rounded border">
                                                                </div>
                                                                @endif
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @if ($appointment->status === 'pending')
                                                <!-- Confirm Button Form -->
                                                <form action="{{ route('admin.appointments.updateStatus', ['appointment' => $appointment->id, 'status' => 'confirmed']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Confirm the appointment">
                                                        <i class="fa-solid fa-square-check"></i>
                                                    </button>
                                                </form>

                                                <!-- Cancel Button Form -->
                                                <form action="{{ route('admin.appointments.updateStatus', ['appointment' => $appointment->id, 'status' => 'cancelled']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Cancel the appointment">
                                                        <i class="fa-solid fa-rectangle-xmark"></i>
                                                    </button>
                                                </form>
                                                @endif

                                                <!-- Delete Button Form (Always Visible) -->
                                                <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete the appointment">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No appointments found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
                        <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span class="fw-bold"
                                style="color: #ff6347;">Coder</span></a>
                    </div>
                    <div>
                        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
                            class="footer-link me-4">Documentation</a>

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