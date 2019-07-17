<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Data Siswa</title>
</head>
<body>
    <div class="container">
        @if(session('berhasil'))
            <div class="alert alert-success" role="alert">
                {{ session('berhasil') }}
            </div>
        @endif

        <div class="row">

            <div class="col-6">
                <h3>Data Siswa</h3>
            </div>

            <div class="col-6">
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#ModalTambah">
                    Tambah
                </button>
            </div>

            <table class="table">
                <tr>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Dibuat Pada</th>
                    <th>Terakhir Diubah</th>
                    <th>Aksi</th>
                </tr>

                @foreach($data as $siswa)
                    <tr>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->jen_kel }}</td>
                        <td>{{ $siswa->agama }}</td>
                        <td>{{ $siswa->no_telp }}</td>
                        <td>{{ $siswa->alamat }}</td>
                        <td>{{ $siswa->created_at }}</td>
                        <td>{{ $siswa->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{$siswa->id}}">
                                Edit
                            </button>
                            <a href="/siswa/delete/{{$siswa->id}}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    {{--Modal--}}
    <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="/siswa/create">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jen_kel" id="inlineRadio1" value="L" checked>
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jen_kel" id="inlineRadio2" value="P">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option>Islam</option>
                                <option>Hindu</option>
                                <option>Budha</option>
                                <option>Katolik</option>
                                <option>Protestan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telp" class="form-control" placeholder="Masukkan nomor telepon">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{--Modal Edit--}}
    @foreach($data as $siswa2)
    <div class="modal fade" id="ModalEdit{{$siswa2->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="/siswa/update/{{$siswa2->id}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" value="{{$siswa2->nama}}">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jen_kel" id="inlineRadio1" value="L" @if($siswa2->jen_kel=='L') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jen_kel" id="inlineRadio2" value="P" @if($siswa2->jen_kel=='P') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option @if($siswa2->agama=='Islam') selected @endif>Islam</option>
                                <option @if($siswa2->agama=='Hindu') selected @endif>Hindu</option>
                                <option @if($siswa2->agama=='Budha') selected @endif>Budha</option>
                                <option @if($siswa2->agama=='Katolik') selected @endif>Katolik</option>
                                <option @if($siswa2->agama=='Protestan') selected @endif>Protestan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telp" class="form-control" placeholder="Masukkan nomor telepon" value="{{$siswa2->no_telp}}">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control">{{$siswa2->alamat}}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>