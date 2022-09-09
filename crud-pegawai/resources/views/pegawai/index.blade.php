@extends('layout.app')

@section('content')

  {{-- Add Modal --}}
  <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="AddStudentModalLabel">Tambah data pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                  <ul id="save_msgList"></ul>

                  <div class="form-group mb-3">
                      <label for="">Nama Pegawai</label>
                      <input type="text" required class="nama_pegawai form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Alamat</label>
                      <input type="text" required class="alamat form-control">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary tambah_pegawai">Save</button>
              </div>
          </div>
      </div>
  </div>


  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit & Update Student Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">

                  <ul id="update_msgList"></ul>

                  <input type="hidden" id="pgw_id" />

                  <div class="form-group mb-3">
                      <label for="">Nama Pegawai</label>
                      <input type="text" id="nama_pegawai" required class="form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Alamat</label>
                      <input type="text" id="alamat" required class="form-control">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary update_pgw">Update</button>
              </div>

          </div>
      </div>
  </div>
  {{-- Edn- Edit Modal --}}


  {{-- Delete Modal --}}
  <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus data pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <h4>Confirm to Delete Data ?</h4>
                  <input type="hidden" id="delete_id">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary delete_pgw">Yes Delete</button>
              </div>
          </div>
      </div>
  </div>
  {{-- End - Delete Modal --}}

   
  <div class="container py-5">
      <div class="row">
          <div class="col-md-12">

              <div id="success_message"></div>

              <div class="card">
                  <div class="card-header">
                      <h4>
                          Data Pegawai
                          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                              data-bs-target="#AddStudentModal">Tambah Pegawai</button>
                      </h4>
                  </div>
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>ID Pegawai</th>
                                  <th>Nama Pegawai</th>
                                  <th>Alamat</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
@endsection

@section('scripts')
<script>
  $(document).ready(function () {

    
        fetchpegawai();

        function fetchpegawai() {
            $.ajax({
                type: "GET",
                url: "/fetch-pegawai",
                dataType: "json",
                success: function (response) {
                    // console.log(response.pegawai);
                    $('tbody').html("");
                    $.each(response.pegawai, function (key, item) {
                        $('tbody').append('<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.nama_pegawai + '</td>\
                            <td>' + item.alamat + '</td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                }
            });
        }

        $(document).on('click', '.deletebtn', function () {
            var pgw_id = $(this).val();
            // console.log(alert(pgw_id));
            $('#DeleteModal').modal('show');
            $('#delete_id').val(pgw_id);
        });

        $(document).on('click','.delete_pgw', function (e) {
            e.preventDefault();

            $(this).text('deleting..');

            var id_pgw = $('#delete_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/delete-pgw/"+ id_pgw,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.delete_pgw').text('Yes Delete');
                    } else {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.delete_pgw').text('Yes Delete');
                        $('#DeleteModal').modal('hide');
                        fetchpegawai();
                    }
                }
            });
        });
        
        
        $(document).on('click','.editbtn', function () {
            var pgw_id = $(this).val();
            // console.log(alert(pgw_id));
            $('#editModal').modal('show');
            $('#pgw_id').val(pgw_id);
            $.ajax({
                type: "GET",
                url: "/edit-pgw/" +pgw_id,
                success: function (response) {
                    console.log(response);
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                        // console.log(response.pegawai.nama_pegawai);
                        $('#nama_pegawai').val(response.pegawai.nama_pegawai);
                        $('#alamat').val(response.pegawai.alamat);
                    }
                }
            });
            $('.btn-close').find('input').val('');
        });
        
        $(document).on('click', '.update_pgw',function (e) {
            e.preventDefault();
            $(this).text('updating..');

            var id = $('#pgw_id').val();
            // console.log(alert(id));
            var data = {
                'nama_pegawai': $('#nama_pegawai').val(),
                'alamat': $('#alamat').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/update-pgw/"+id,
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.error, function (key, err_value) {
                            $('#update_msgList').append('<li>' + err_value +
                                '</li>');
                        });
                        $('.update_student').text('Update');
                    } else {
                        $('#update_msgList').html("");

                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').find('input').val('');
                        $('.update_pgw').text('Update');
                        $('#editModal').modal('hide');
                        fetchpegawai();
                    }
                }
            });

        });

        $(document).on('click', '.tambah_pegawai', function (e) {
            e.preventDefault();
        
            $(this).text('Sending..');

            var data = {
                'nama_pegawai': $('.nama_pegawai').val(),
                'alamat': $('.alamat').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/pegawai",
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $.each(response.error, function (key, err_value) {
                            $('#save_msgList').append('<li>' + err_value + '</li>');
                        });
                        $('.tambah_pegawai').text('Save');
                    } else {
                        $('#save_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddStudentModal').find('input').val('');
                        $('.tambah_pegawai').text('Save');
                        $('#AddStudentModal').modal('hide');
                        fetchpegawai();
                    }
                }
            });
    });


            
  });
</script>
@endsection