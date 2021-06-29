<div class="filter">
    <div class="filter-title">
        <h2>Filtro</h2>
    </div>
    <div class="filter-content">
        <div class="filter-item">
            <div class="filter-item-title">
                <h3>Categorias</h3>
            </div>
            <div class="container-filter">
                <div class="form-group">
                    <a href="{{ route('store.products') }}" class="custom-control custom-checkbox">
                        @if ( $filterCategory == 'todas')
                        <input checked type="radio" name="category" value="todas"
                        class="custom-control-input">
                        @else
                        <input type="radio" name="category" value="todas"
                        class="custom-control-input">
                        @endif
                        <span class="custom-control-indicator">Todas</span>
                    </a>
                </div>
                @foreach($categories as $category )
                    <div class="form-group">
                        <a href="{{ route('store.product.filter.by.category',  $category->slug) }}" class="custom-control custom-checkbox">
                            @if ($category->slug == $filterCategory)
                            <input type="radio" checked name="category" value="{{ $category->name }}"
                            class="custom-control-input">
                            @else
                            <input type="radio" name="category" value="{{ $category->name }}"
                            class="custom-control-input">
                            @endif
                            <span class="custom-control-indicator">{{ $category->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="filter-item">
            <div class="filter-item-title">
                <h3>Marcas</h3>
            </div>
            <div class="container-filter">
                <div class="form-group">
                    <a href="{{ route('store.products') }}" class="custom-control custom-checkbox">
                        @if ( $filterBrand == 'todas')
                        <input checked type="radio" name="brade" value="todas"
                        class="custom-control-input">
                        @else
                        <input type="radio" name="brade" value="todas"
                        class="custom-control-input">
                        @endif
                        <span class="custom-control-indicator">Todas</span>
                    </a>
                </div>
                @foreach($brades as $brade )
                    <div class="form-group">
                        <a href="{{ route('store.product.filter.by.brand', Str::slug($brade->slug)) }}" class="custom-control custom-checkbox">
                            @if ($brade->slug == $filterBrand)
                            <input type="radio" checked name="brade" value="{{ $brade->name }}"
                            class="custom-control-input">
                            @else
                            <input type="radio" name="brade" value="{{ $brade->name }}"
                            class="custom-control-input">
                            @endif
                            <span class="custom-control-indicator">{{ $brade->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
