@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Miembros</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($members as $member)
    <x-membership-card :member="$member" />
    @endforeach
</div>
@endsection