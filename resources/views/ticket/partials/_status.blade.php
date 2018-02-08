@switch($status)
    @case('open')
        <span class="badge badge-success">Open</span>
        @break
    @case('hold')
        <span class="badge badge-warning">Awaiting your response</span>
        @break
    @case('closed')
        <span class="badge badge-secondary">Closed</span>
        @break
@endswitch
