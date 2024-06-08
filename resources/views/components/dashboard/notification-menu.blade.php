<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                class="dropdown-item @if ($notification->unread()) text-bold @endif">
                <i class="mr-2 {{ $notification->data['icon'] }}"></i>
                {{ $notification->data['body'] }}
                <span class="float-right text-sm text-muted">
                    {{ $notification->created_at->shortAbsoluteDiffForHumans() }}
                </span>
            </a>
        @endforeach
        <div class="dropdown-divider"></div>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
