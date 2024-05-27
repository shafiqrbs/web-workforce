@foreach (session('flash_notification', collect())->toArray() as $message)
@if ($message['overlay'])
@include('flash::modal', [
'modalClass' => 'flash-modal',
'title'      => $message['title'],
'body'       => $message['message']
])
@else

<div style="border-width: 1px;padding: 15px;border: 1px solid transparent;" class="
     alert-{{ $message['level'] }}
     {{ $message['important'] ? 'alert-important' : '' }}"
     role="alert"
     >
    @if ($message['important'])
    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-hidden="true"
            >&times;</button>
    @endif
    {!! $message['message'] !!}
</div>
@endif
@endforeach
{{ session()->forget('flash_notification') }}
