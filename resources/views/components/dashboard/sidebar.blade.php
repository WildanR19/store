<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <img src="/images/dashboard-store-logo.svg" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
        <a
            href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action"
        >Dashboard</a
        >
        <a
            href="{{ route('dashboard.product') }}"
            class="list-group-item list-group-item-action"
        >My Products</a
        >
        <a
            href="{{ route('dashboard.transaction') }}"
            class="list-group-item list-group-item-action"
        >Transactions</a
        >
        <a
            href="{{ route('dashboard.store') }}"
            class="list-group-item list-group-item-action"
        >Store Settings</a
        >
        <a
            href="{{ route('dashboard.account') }}"
            class="list-group-item list-group-item-action"
        >My Account</a
        >
    </div>
</div>
