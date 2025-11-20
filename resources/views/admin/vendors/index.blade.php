@extends('admin.layout')
@section('content')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-content-center justify-content-between">
                        <h3 class="font-weight-bold text-xl">Data Vendors</h3>
                        <div class="d-flex align-items-center">
                            {{-- @if (isset($permissions['tambah']) && $permissions['tambah'] == 1)
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm">
                                    <i class="bi bi-plus-lg"></i> Tambah Guru
                                </button>
                            @endif --}}


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" id="btnTambah"
                                data-bs-target="#modalForm">
                                <i class="bi bi-plus-lg"></i> Tambah Vendors
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table data-table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th width="170px">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalForm" tabIndex={-1} role="dialog" data-focus="false" aria-labelledby="modalFormLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title text-white font-weight-bold position-absolute start-50 translate-middle-x"
                        id="modalFormLabel">

                    </h5>
                    <div class="invisible">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>


                <form id="formData">
                    @csrf
                    <input type="hidden" id="primary_id" name="primary_id" />
                    <div class="modal-body">
                        <div class="col-md-12">




                            <div class="form-group row mb-3">
                                <label for="name" class="col-sm-4 col-form-label">Nama Vendor</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan nama Vendor">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="phone" class="col-sm-4 col-form-label">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Masukkan nomor telepon">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email">
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary ms-1" id="submitBtn">
                            <span class="spinner-border spinner-border-sm mx-1 d-none" role="status"
                                aria-hidden="true"></span>
                            <span class="button-text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    var audio = new Audio('{{ asset('audio/notification.ogg') }}');
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: false,
            ajax: "{{ route('vendors.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }]
        });
    });

    $('#formData').on('submit', function(e) {
        e.preventDefault();

        let submitBtn = $('#submitBtn');
        let spinner = submitBtn.find('.spinner-border');
        let btnText = submitBtn.find('.button-text');

        spinner.removeClass('d-none');
        btnText.text('Menyimpan...');
        submitBtn.prop('disabled', true);

        let primaryId = $('#primary_id').val();

        let url, method;
        if (primaryId) {
            url = "{{ route('vendors.update', ':id') }}".replace(':id', primaryId);
            method = 'PUT';
        } else {
            url = "{{ route('vendors.store') }}";
            method = 'POST';
        }

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        let formData = new FormData(this);
        formData.append('_method', method);

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                audio.play()
                let msg = primaryId ?
                    "Data Vendor berhasil diperbarui" :
                    "Data Vendor berhasil ditambahkan";
                toastr.success(msg, "BERHASIL", {
                    progressBar: true,
                    timeOut: 3500,
                    positionClass: "toast-bottom-right",
                });
                $('.data-table').DataTable().ajax.reload();
                spinner.addClass('d-none');
                btnText.text('Simpan');
                submitBtn.prop('disabled', false);
                $('#modalForm').modal('hide');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    audio.play()
                    toastr.error("Ada inputan yang salah!", "GAGAL!", {
                        progressBar: true,
                        timeOut: 3500,
                        positionClass: "toast-bottom-right",
                    });

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, val) {
                        let input = $('#' + key);
                        input.addClass('is-invalid');
                        input.parent().find('.invalid-feedback').remove();
                        input.parent().append(
                            '<span class="invalid-feedback" role="alert"><strong>' +
                            val[0] + '</strong></span>'
                        );
                    });

                    spinner.addClass('d-none');
                    btnText.text('Simpan');
                    submitBtn.prop('disabled', false);
                } else {
                    audio.play()
                    toastr.error("Terjadi kesalahan di sistem", "GAGAL!", {
                        progressBar: true,
                        timeOut: 3500,
                        positionClass: "toast-bottom-right",
                    });

                    spinner.addClass('d-none');
                    btnText.text('Simpan');
                    submitBtn.prop('disabled', false);
                }
            }
        });
    });

    $(document).on('click', '.editBtn', function() {
        let url = $(this).data('url');

        $.get(url, function(response) {
            if (response.status === 'success') {
                $('#primary_id').val(response.data.id);
                $('#name').val(response.data.name);
                $('#address').val(response.data.address);
                $('#phone').val(response.data.phone);
                $('#email').val(response.data.email);

                $('#modalForm').modal('show');
                $('#modalFormLabel').text("Edit Vendor");
                $('.button-text').text("Update");
            }
        });
    });

    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();

        let url = $(this).data('url');

        Swal.fire({
            title: 'Yakin hapus?',
            text: 'Data Vendor akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary'
            },
            preConfirm: () => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            toastr.success("Data berhasil dihapus!", "Berhasil");
                            $('.data-table').DataTable().ajax.reload(null, false);
                            resolve(true);
                        },
                        error: function() {
                            toastr.error("Gagal menghapus data", "Gagal");
                            reject("Error");
                        }
                    });
                });
            }
        });
    });

    $('#modalForm').on('hidden.bs.modal', function() {
        $('#formData')[0].reset();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $('#primary_id').val('');

        let submitBtn = $('#submitBtn');
        let spinner = submitBtn.find('.spinner-border');
        let btnText = submitBtn.find('.button-text');

        spinner.addClass('d-none');
        btnText.text('Simpan');
        submitBtn.prop('disabled', false);

        $('#modalFormLabel').text('Tambah Vendor');
    });
</script>
@endpush
