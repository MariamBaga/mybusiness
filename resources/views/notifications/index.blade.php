@extends('adminlte::page')

@section('title', 'Notifications')

@section('content_header')
    <h1>Toutes les notifications</h1>
@stop

@section('content')

<h4>Notifications non lues</h4>
<ul>
    @forelse($unread as $notif)
        <li>
            {{ $notif->data['message'] ?? 'Notification' }}
            <form action="{{ route('notifications.read', $notif->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-sm btn-primary">Marquer comme lue</button>
            </form>
        </li>
    @empty
        <p>Aucune notification non lue.</p>
    @endforelse
</ul>

<hr>

<h4>Notifications lues</h4>
<ul>
    @forelse($read as $notif)
        <li>{{ $notif->data['message'] ?? 'Notification' }}</li>
    @empty
        <p>Aucune notification lue.</p>
    @endforelse
</ul>

@stop
