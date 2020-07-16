@if (Auth::guard('web')->check())
    <div class="text-success">
        You're Logged In as a <strong>User</strong>
    </div>
@else
    <div class="text-danger">
        You're Logged Out as a <strong>User</strong>
    </div>
@endif

@if (Auth::guard('admin')->check())
    <div class="text-success">
        You're Logged In as a <strong>Admin</strong>
    </div>
@else
    <div class="text-danger">
        You're Logged Out as a <strong>Admin</strong>
    </div>
@endif