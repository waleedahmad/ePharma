<div class="admin-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">

    <a @if(Request::path() === 'branch/medicines') class="active" @endif href="/branch/medicines">Medicines</a>

    <a @if(Request::path() === 'branch/stock') class="active" @endif  href="/branch/stock">Stock</a>

    <a @if(Request::path() === 'branch/orders') class="active" @endif  href="/branch/orders">Orders</a>
</div>