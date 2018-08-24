<div class="footer">
    <div class="text-left">
        <strong>
            {{ env('APP_NAME', 'New Project')}} &reg;{{ date('Y') }}
        </strong>
        <span class="text-muted small pull-right">
            {{ \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y') }}
        </span>
    </div>
</div>