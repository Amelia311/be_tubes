@extends('AdminSekolah.layouts.admin')

@section('title', 'Data Disimpan')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_input.css') }}">
</head>
<body>
  <div class="container">
    <div class="main-content" style="padding: 40px;">
      <h2 style="margin-bottom: 20px;">✅ Data pencairan berhasil disimpan!</h2>
      <a href="{{ route('pencairan.create') }}" style="color: white; background-color: #3b82f6; padding: 10px 20px; border-radius: 6px; text-decoration: none;">Input Lagi</a>
    </div>
  </div>
  @endsection
