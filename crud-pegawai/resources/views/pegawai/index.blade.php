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
                      <input type="text" required class="name form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Alamat</label>
                      <input type="text" required class="course form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Kontrak</label>
                      <input type="text" required class="email form-control">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary add_student">Save</button>
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

                  <input type="hidden" id="stud_id" />

                  <div class="form-group mb-3">
                      <label for="">Full Name</label>
                      <input type="text" id="name" required class="form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Course</label>
                      <input type="text" id="course" required class="form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Email</label>
                      <input type="text" id="email" required class="form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Phone No</label>
                      <input type="text" id="phone" required class="form-control">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary update_student">Update</button>
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
                  <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <h4>Confirm to Delete Data ?</h4>
                  <input type="hidden" id="deleteing_id">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary delete_student">Yes Delete</button>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.add_student', function (e) {
              e.preventDefault();
              console.log('sucess');
            });
  });
</script>
@endsection