<div>
    <div class="form-row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Categoría de productos</label>
                <select wire:model="category" class="form-control">
                    <option value="">Todos los productos</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Cantidad de productos</label>
                <select wire:model="showCount" class="form-control">
                    <option value="9">9 Productos</option>
                    <option value="15">15 Productos</option>
                    <option value="21">21 Productos</option>
                    <option value="30">30 Productos</option>
                    <option value="">All Productos</option>
                </select>
            </div>
        </div>
    </div>
</div>
