<form class="theme-form" id="{{$data == null ? "create-form" : "edit-form"}}" data-target="{{$data == null ? "" : url('pegawai/update/'.$data->id)}}" onsubmit="return false;">
    {{ csrf_field() }}
    <div class="mb-3">
        <label class="form-label pt-0">Nama Pegawai</label>
        <input class="form-control" id="nama" name="nama" value="{{ $data == null ? "" : $data->nama}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Posisi</label>
        <select name="id_role" id="id_role" class="form-select" required>
            <option value="Admin" {{$data != null ? $data->user_id == 1 ? "selected" : "" : ""}}>Admin</option>
            <option value="Kasir" {{$data != null ? $data->user_id == 2 ? "selected" : "" : ""}}>Kasir</option>
            <option value="Koki" {{$data != null ? $data->user_id == 3 ? "selected" : "" : ""}}>Koki</option>
            <option value="Pelayan" {{$data != null ? $data->user_id == 4 ? "selected" : "" : ""}}>Pelayan</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Alamat</label>
        <input class="form-control" id="alamat" name="alamat" value="{{ $data == null ? "" : $data->alamat}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">No. Telephone</label>
        <input class="form-control" id="telp" name="telp" minlength="0" value="{{ $data == null ? "" : $data->telp}}" type="number" required />
    </div>
   
    <button class="btn btn-primary" type="submit">Kirim</button>
</form>