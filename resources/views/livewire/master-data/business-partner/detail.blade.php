<div class="row">
    <form wire:submit="store">
        <div class='row'>
            <div class="col-md-10 mb-4">
                <label>Nama Mitra Bisnis</label>
                <input placeholder="Nama Mitra Bisnis" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" />
    
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Level Harga</label>
                <select class="form-select w-100" wire:model='price_level_id'>
                    
                    @php $isFound = false; @endphp

                    @foreach ($price_level_choices as $item)
                        @php  $isFound = $isFound || $item['id'] == $price_level_id; @endphp
                        <option value="{{ $item['id'] }}" {{$isFound ? 'selected' : ''}}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
    
                @error('price_level_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10 mb-4">
                <label>Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" cols="30" rows="4" wire:model="address"></textarea>
    
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group mt-5">
                <label>No Telp</label>
                <div class="input-group" wire:ignore>
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control phone @error('phone') is-invalid @enderror" name="phone" model-name="phone" min="1" placeholder="8XX-XXXX-XXXX" aria-label="phone" aria-describedby="basic-addon1" value="{{ $phone }}">
                </div>
                <div class="form-text" id="basic-addon4">Contoh +62 8XX-XXXX-XXXX</div>
            </div>

            <div class="col-md-4 mb-4 row align-items-end">
                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" wire:model="is_customer">
                    <label class="form-label ms-2 mb-2">
                        Mitra Pelanggan
                    </label>
                </div>

                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" wire:model="is_supplier">
                    <label class="form-label ms-2 mb-2">
                        Mitra Supplier
                    </label>
                </div>

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

