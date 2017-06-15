<div class="admin-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">

    <a @if(Request::path() === 'admin/companies') class="active" @endif href="/admin/companies">Companies</a>

    <a @if(Request::path() === 'admin/branches') class="active" @endif  href="/admin/branches">Branches</a>

    <a @if(Request::path() === 'admin/users') class="active" @endif  href="/admin/users">Administrators</a>
</div>