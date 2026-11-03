<div class="dropdown mx-2" x-data="notificationComponent()" x-init="listen()" id="bell-dropdown">
  <button class="dropdown-toggle position-relative" id="alertsDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bell fa-lg"></i>
    <span x-text="unreadCount" x-show="unreadCount > 0" class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger"></span>
  </button>
  <ul class="dropdown-menu" style="min-width: 320px;">
    <li class="px-3 py-2 fw-bold">
        الإشعارات
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <template x-for="notification in notifications">
        <li>
            <a :href="notification.url" class="dropdown-item d-flex align-items-start gap-2" style="white-space: normal;">
                <div class="flex-shrink-0">
                    <img :src="notification.icon" class="rounded-circle" width="40px" height="40px">
                </div>
                <div class="flex-grow-1 me-2 overflow-hidden">
                    <div x-text="notification.created_at" class="small text-muted"></div>
                    <div x-html="notification.content" class="text-wrap" style="word-break: break-word;"></div>
                </div>
            </a>
        </li>
    </template>

    <li class="text-center py-2 text-muted" x-show="notifications.length === 0">
        لا توجد إشعارات غير مقروءة
    </li>

    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item text-center small text-primary" href="{{ route('notifications.index') }}">عرض جميع الإشعارات</a></li>
  </ul>
</div>

@push('scripts')
<script>
function notificationComponent(){
    return {
        unreadCount: {{ $unread_notifications_count }},
        notifications: @json($notifications ?? []),

        listen(){
            const userID = {{ auth()->id() }};
            if(!userID) return;

            Echo.private(`App.Models.User.${userID}`)
                .notification((e)=>{
                    this.unreadCount = e.unread_notifications_count;
                    this.notifications = e.notifications;
                })
        },

        markAllAsRead(){
            if(this.unreadCount === 0) return;
            fetch("{{ route('notifications.read') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }).then(response => {
                if(response.ok){
                    this.unreadCount = 0;
                }
            })
        }
    }
}

const dropdown = document.getElementById('bell-dropdown');

dropdown.addEventListener('show.bs.dropdown', function(){
    const alpineComponent = Alpine.$data(dropdown);
    alpineComponent.markAllAsRead();
});
</script>   
@endpush
