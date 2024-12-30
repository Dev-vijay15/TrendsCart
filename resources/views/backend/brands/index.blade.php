@extends('backend.layouts.app')
@section('content')
    <style>
        /* Custom Modal Styling */
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        #permissionModal .row {
            font-size: 16px;
            padding: 8px 0;
        }

        .fw-bold {
            font-weight: 600;
        }
    </style>



    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All brand</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Brands</div>
                    </li>
                </ul>
            </div>


            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success" style="font-size: 20px">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="alert alert-danger" style="font-size: 20px">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href=" {{ route('brands.create') }}">
                        <i class="icon-plus"></i>Add new</a>
                </div>
                <div class="table-responsive">
                    <table id="brandsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($brands->count() > 0)
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug}}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <button type="button" class="show" data-id="{{ $brand->id }}">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </button>
                                                <a href="{{ route('brands.edit', $brand->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <button type="button" class="delete" data-id="{{ $brand->id }}">
                                                    <div class="item text-danger">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"  class="text-center">No data found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>



                </div>
                {{-- <div>
                    {!! $brands->withQueryString()->links('pagination::bootstrap-5') !!}
                </div> --}}

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">


                </div>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->
    <div class="modal fade" id="BrandModal" tabindex="-1" aria-labelledby="BrandModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="BrandModalLabel">Brand Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Brand Name:</div>
                        <div class="col-md-8" id="permission-name"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Created At:</div>
                        <div class="col-md-8" id="permission-created-at"></div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('#brandsTable').DataTable({
                paging: false, // Disable pagination
                searching: false, // Disable searching
                info: false,
                ordering: true, // Enable column sorting
                responsive: true, // Enable responsive design

            });


        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.delete', function() {
                var brandId = $(this).data('id'); // Get ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request to delete
                        $.ajax({
                            url: "{{ route('brands.destroy', ':id') }}".replace(':id',
                                brandId),
                            method: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}" // CSRF Token
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location
                                        .reload(); // Reload the page or update the DOM
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Unable to delete. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Show permission details in modal
            $(document).on('click', '.show', function() {
                var brandId = $(this).data('id');

                $.ajax({
                    url: "{{ route('brands.show', ':id') }}".replace(':id', brandId),
                    method: "GET",
                    success: function(response) {
                        $('#permission-name').text(response.name);
                        $('#permission-created-at').text(response.created_at);
                        $('#BrandsModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch permission details.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
