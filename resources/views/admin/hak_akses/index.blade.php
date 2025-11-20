@extends('admin.layout')
@section('content')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-content-center justify-content-between">
                        <h3 class="font-weight-bold text-xl">Hak Akses</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-center">
                        <label for="" class="col-sm-2 col-form-label">Pilih Pengguna</label>
                        <div class="col-sm-3">
                            <select class="form-select select-pengguna" id="pilih-pengguna">
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table data-table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">ID</th>
                                    <th width="15%">Induk Menu</th>
                                    <th width="15%">Judul Menu</th>
                                    <th width="15%">Route</th>
                                    <th width="8%">Lihat</th>
                                    <th width="8%">Beranda</th>
                                    <th width="8%">Tambah</th>
                                    <th width="8%">Edit</th>
                                    <th width="8%">Hapus</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        @if ($permissions['edit'] == 1)
                            <div class="text-left mt-4 mb-4">
                                <button type="submit" class="btn btn-primary ms-1" id="btn-simpan" disabled>
                                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status"
                                        aria-hidden="true"></span>
                                    <span class="button-text">Simpan Hak Akses</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
<script>
    var table;
    var selectedUserId = null;
    var audio = new Audio('{{ asset('audio/notification.ogg') }}');
    $(function() {
        
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            ordering: false,
            searching: false,
            paging: false,
            info: false,
            ajax: {
                url: "{{ route('hak-akses.index') }}",
                data: function(d) {
                    d.user_id = selectedUserId;
                }
            },
            columns: [
                {
                    data: 'no',
                    name: 'no',
                    className: 'text-center'
                },
                {
                    data: 'id',
                    name: 'id',
                    className: 'text-center'
                },
                {
                    data: 'parent_menu',
                    name: 'parent_menu'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'route_name',
                    name: 'route_name'
                },
                {
                    data: 'lihat',
                    name: 'lihat',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'beranda',
                    name: 'beranda',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tambah',
                    name: 'tambah',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'edit',
                    name: 'edit',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'hapus',
                    name: 'hapus',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    
    $('#pilih-pengguna').on('change', function() {
        selectedUserId = $(this).val();
        
        if (selectedUserId) {
            
            table.ajax.reload();
            
            
            $('#btn-simpan').prop('disabled', false);
        } else {
            $('#btn-simpan').prop('disabled', true);
        }
    });

    
    $(document).on('change', '.checkbox-akses', function() {
        if (selectedUserId) {
            $('#btn-simpan').prop('disabled', false);
        }
    });

    
    $('#btn-simpan').on('click', function(e) {
        e.preventDefault();

        if (!selectedUserId) {
            toastr.error("Pilih pengguna terlebih dahulu", "GAGAL!", {
                progressBar: true,
                timeOut: 3500,
                positionClass: "toast-bottom-right",
            });
            return;
        }

        let submitBtn = $(this);
        let spinner = submitBtn.find('.spinner-border');
        let btnText = submitBtn.find('.button-text');

        spinner.removeClass('d-none');
        btnText.text('Menyimpan...');
        submitBtn.prop('disabled', true);

        
        let permissions = [];
        $('.checkbox-akses:checked').each(function() {
            permissions.push({
                menu_id: $(this).data('menu'),
                type: $(this).data('type')
            });
        });

        $.ajax({
            url: "{{ route('hak-akses.store') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                user_id: selectedUserId,
                permissions: permissions
            },
            success: function(response) {
                audio.play()
                toastr.success(response.message || "Hak akses berhasil disimpan", "BERHASIL", {
                    progressBar: true,
                    timeOut: 3500,
                    positionClass: "toast-bottom-right",
                });

                spinner.addClass('d-none');
                btnText.text('Simpan Hak Akses');
                submitBtn.prop('disabled', false);

                
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                audio.play()
                let errorMsg = "Terjadi kesalahan di sistem";
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                toastr.error(errorMsg, "GAGAL!", {
                    progressBar: true,
                    timeOut: 3500,
                    positionClass: "toast-bottom-right",
                });

                spinner.addClass('d-none');
                btnText.text('Simpan Hak Akses');
                submitBtn.prop('disabled', false);
            }
        });
    });
</script>
@endpush
