<div class="row">
    <form wire:submit="store">
        <div class='row'>

            <div class="col-md-10 mb-4">
                <label>Nama Produk</label>
                <input placeholder="Nama Produk" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" />
    
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-10 mb-4">
                <label>Deskripsi</label>
                <textarea rows="4" placeholder="Deskripsi" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
    
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 mb-4">
                <label>Merek</label>
                <input placeholder="Merek" type="text" class="form-control @error('brand') is-invalid @enderror" wire:model="brand" />
    
                @error('brand')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-5 mb-4">
                <label>Kategori Produk</label>
                <select class="form-select w-100" wire:model='product_category_id'>
                    <option value="">Pilih Kategori Produk</option>
                    @php $isFoundCategory = false; @endphp

                    @foreach ($product_category_choices as $key => $category)
                        @php $isFoundCategory = $isFoundCategory || $category['id'] == $product_category_id; @endphp
                        <option value="{{ $category['id'] }}" {{$isFoundCategory ? 'selected' : ''}}>{{ $category['name'] }}</option>
                    @endforeach
                </select>
    
                @error('product_categor_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-5 mb-4">
                <label>Jenis Produk</label>
                <select class="form-select w-100" wire:model='type'>
                    @php $isFound = false; @endphp

                    @foreach ($type_choices as $type_value => $type_name)
                        @php $isFound = $isFound || $type_value == $type; @endphp
                        <option value="{{ $type_value }}" {{$isFound ? 'selected' : ''}}>{{ $type_name }}</option>
                    @endforeach
                </select>
    
                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 mb-4">
                <label>Harga Beli (HPP)</label>
                <input placeholder="Harga Beli (HPP)" type="text" class="form-control currency @error('purchase_price') is-invalid @enderror" wire:model="purchase_price" />
    
                @error('purchase_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 mb-4">
                <label>Stok Minimal</label>
                <input placeholder="Stok Minimal" type="text" class="form-control currency @error('min_stock') is-invalid @enderror" wire:model="min_stock" />
    
                @error('min_stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 mb-4">
                <label>Stok Maksimal</label>
                <input placeholder="Stok Maksimal" type="text" class="form-control currency @error('max_stock') is-invalid @enderror" wire:model="max_stock" />
    
                @error('max_stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Active Option -->
            
            <div class="col-md-10 mb-4 row align-items-end">
                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                    <label class="form-label ms-2 mb-2">
                        Penanda Aktif
                    </label>
                </div>
            </div>

            @foreach ($product_units as $index => $unit)
                @if (!$index)
                    <div class="col-md-7 mb-4">
                        <label>Nama Produk</label>
                        <input placeholder="Nama Produk" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" />
            
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>Nama Produk</label>
                        <input placeholder="Nama Produk" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" />
            
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @else
                    
                @endif
            @endforeach
            
            <div class="col-md-10 mb-4">
                <button type="submit" class="btn btn-success mt-3 w-100">
                    Simpan
                </button>
            </div>

    
    </form>
</div>

@include('js.imask')

