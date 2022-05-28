@extends('adminlte::page')

@section('title', 'Split KC: ' . $kc->name)

@section('content_header')
<li class="breadcrumb-item active">Split KC</li>
@endsection

@section('content')
<livewire:teacher.kc.split :kc="$kc" :course="$course" :questions="$questions" :lessons="$lessons" />
@endsection