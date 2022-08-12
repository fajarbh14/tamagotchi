<form class="theme-form" id="{{$data == null ? "create-form" : "edit-form"}}" data-target="{{$data == null ? "" : url('pelanggan/'.$data->id.'/update')}}" onsubmit="return false;">
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
        <label class="form-label pt-0">No Meja</label>
        <input class="form-control" id="no_meja" name="no_meja" value="{{ $data == null ? "" : $data->no_meja}}" type="number" min="1" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="Kosong" {{($data != null && ($data->status == "kosong")) ? "selected" : ""}}>Kosong</option>
            <option value="Dipakai" {{($data != null && ($data->status == "digunakan")) ? "selected" : ""}}>Dipakai</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Kirim</button>
</form>