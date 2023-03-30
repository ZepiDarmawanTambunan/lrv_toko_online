@extends('layouts.admin')


@section('title', 'Admin Category')
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">
                    List of Categories
                </p>
            </div>
            <div class="dashboard-content">
                <form action="{{ route('admin-category.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-danger delete mb-3 d-none"
                                        onclick="return confirm('Are you sure you want to delete selected data?')">Delete
                                        Selected Data</button>
                                    <a href="{{ route('admin-category.create') }}" class="btn btn-primary mb-3">
                                        + Tambah Kategori Baru
                                    </a>
                                    <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Foto</th>
                                                    <th>Slug</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('addon-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + full.id + '">';
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });

        $('#crudTable').on('click', 'input[type="checkbox"]', function() {
            if ($('input[type="checkbox"]:checked').length > 0) {
                $('.delete').removeClass('d-none');
            } else {
                $('.delete').addClass('d-none');
            }
        });
    </script>
@endpush
