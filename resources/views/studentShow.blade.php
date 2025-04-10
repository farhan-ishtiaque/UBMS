@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Student Details</h2>

    <div class="card p-4">
        <p><strong>Full Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</p>
        <p><strong>Gender:</strong> {{ ucfirst($student->gender) }}</p>
        <p><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
        <p><strong>CGPA:</strong> {{ $student->cgpa ?? 'N/A' }}</p>
        <p><strong>Graduation Status:</strong> {{ ucfirst(str_replace('_', ' ', $student->graduation_status)) }}</p>
        <p><strong>Graduation Date:</strong> {{ $student->graduation_date ?? 'N/A' }}</p>
        <p><strong>Department:</strong> {{ $student->department->name ?? 'N/A' }}</p>
        <p><strong>University:</strong> 
