@extends('layouts.main-view')

@if(Auth::user()->level == 'Admin')
@include('section.admin')
@elseif(Auth::user()->level == 'Customer')
@include('section.costumer')
@endif