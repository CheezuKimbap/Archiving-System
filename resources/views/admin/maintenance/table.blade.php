@extends('layouts.admin.master')

@section('title', 'PENRO Archiving System')

@section('content')

    <x-maintenance.table :speciesType="$speciesType" />

@endsection
