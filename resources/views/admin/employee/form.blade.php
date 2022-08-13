<form class="theme-form" id="{{$data == null ? "create-form" : "edit-form"}}" data-target="{{$data == null ? "" : url('pegawai/update/'.$data->id)}}" onsubmit="return false;">
    {{ csrf_field() }}
    <div class="mb-3">
        <label class="form-label pt-0">Pilih User</label>
        <select name="user_id" id="user_id" class="form-select" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{($data != null && ($user->id == $data->user_id)) ? "selected" : ""}}>{{$user->nama}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Nama Pegawai</label>
        <input class="form-control" id="nama" name="nama" value="{{ $data == null ? "" : $data->nama}}" type="text" required />
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