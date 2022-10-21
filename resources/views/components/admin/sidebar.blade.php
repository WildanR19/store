<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <img src="{{ url('/images/admin.png') }}" alt="" class="my-4" style="max-width: 150px" />
    </div>
    <div class="list-group list-group-flush">
        <a
            href="{{ route('admin') }}"
            class="list-group-item list-group-item-action">
            Dashboard
        </a>
        <a
            href="{{ route('product.index') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/product') ? 'active' : '' }}">
            Products
        </a>
        <a
            href="{{ route('product-gallery.index') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/product-gallery*') ? 'active' : '' }}">
            Product Galleries
        </a>
        <a
            href="{{ route('category.index') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">
            Categories
        </a>
        <a
            href="{{ route('dashboard.transaction') }}"
            class="list-group-item list-group-item-action">
            Transactions
        </a>
        <a
            href="{{ route('user.index') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">
            Users
        </a>
    </div>
</div>
