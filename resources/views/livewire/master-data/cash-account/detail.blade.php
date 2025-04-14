<div class="row">
    <form wire:submit="store">
        <div class='row'>
            <div class="col-md-10 mb-4">
                <label>Jenis Akun Kas</label>
                <select class="form-select w-100" wire:model='type'>
                    @php $isFoundType = false; @endphp

                    @foreach ($type_choices as $type_value => $type_name)
                        @php $isFoundType = $isFoundType || $type_value == $type; @endphp
                        <option value="{{ $type_value }}" {{$isFoundType ? 'selected' : ''}}>{{ $type_name }}</option>
                    @endforeach
                </select>
    
                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Nama Akun Kas</label>
                <input placeholder="Nama Akun Kas" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" />
    
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Saldo Saat Ini</label>
                <input placeholder="Saldo Saat Ini" type="text" class="form-control currency @error('current_balance') is-invalid @enderror" wire:model="current_balance" />
    
                @error('current_balance')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Jenis Biaya Admin</label>
                <select class="form-select w-100" wire:model='admin_type'>
                    @php $isFound = false; @endphp

                    @foreach ($admin_type_choices as $admin_type_value => $admin_type_name)
                        @php $isFound = $isFound || $admin_type_value == $admin_type; @endphp
                        <option value="{{ $admin_type_value }}" {{$isFound ? 'selected' : ''}}>{{ $admin_type_name }}</option>
                    @endforeach
                </select>
    
                @error('admin_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Nilai Biaya Admin</label>
                <input placeholder="Nilai Biaya Admin" type="text" class="form-control currency @error('admin_fee') is-invalid @enderror" wire:model="admin_fee" />
    
                @error('admin_fee')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Active Option -->
            
            <div class="col-md-4 mb-4 row align-items-end">
                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                    <label class="form-label ms-2 mb-2">
                        Penanda Aktif
                    </label>
                </div>
            </div>
            <div class="col-md-10 mb-4">
                <button type="submit" class="btn btn-success mt-3 w-100">
                    Simpan
                </button>
            </div>

    
    </form>
</div>

@include('js.imask')

