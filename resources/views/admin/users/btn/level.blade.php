<span class="badge
    {{ $level == 'user'?'badge-info':'' }}
    {{ $level == 'vendor'?'badge-primary':'' }}
    {{ $level == 'company'?'badge-success':'' }}
">
    {{ trans('user.'.$level) }}
</span>
