@extends('layouts.app')

@section('content')
<style>
  /* Bao quanh form */
  .form-wrapper {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px 30px 40px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgb(0 0 0 / 0.1);
  }

  /* Label */
  label {
    font-weight: 600;
    font-size: 1rem;
  }

  /* Wrapper input để đặt icon */
  .input-icon-wrapper {
    position: relative;
  }

  /* Icon bên trái */
  .input-icon-wrapper .input-icon {
    position: absolute;
    top: 50%;
    left: 16px;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.2rem;
    pointer-events: none;
  }

  /* Input bo góc, padding-left để chừa chỗ icon */
  input[type="text"],
  input[type="number"],
  input[type="file"],
  input[type="email"],
  textarea {
    width: 100%;
    padding: 10px 14px 10px 44px;
    font-size: 1rem;
    border-radius: 10px;
    border: 1.8px solid #ced4da;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  /* Khi input focus */
  input[type="text"]:focus,
  input[type="number"]:focus,
  input[type="file"]:focus,
  input[type="email"]:focus,
  textarea:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 6px rgb(13 110 253 / 0.4);
  }

  /* Lỗi validate */
  .is-invalid {
    border-color: #dc3545 !important;
  }

  .invalid-feedback {
    font-size: 0.875rem;
  }

  /* File input đặc biệt */
  input[type="file"] {
    padding-left: 44px !important;
    height: 44px;
  }

  /* Text nhỏ hướng dẫn */
  .form-text {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 4px;
  }

  /* Nút submit */
  .btn-submit {
    background-color: #0d6efd;
    border: none;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 12px;
    padding: 12px 0;
    box-shadow: 0 5px 15px rgb(13 110 253 / 0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
  }

  .btn-submit:hover {
    background-color: #0b5ed7;
    box-shadow: 0 8px 20px rgb(11 94 215 / 0.6);
  }

  /* Tiêu đề form */
  .form-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #0d6efd;
    text-align: center;
    margin-bottom: 30px;
    letter-spacing: 0.05em;
  }
</style>

<div class="form-wrapper">
  <h2 class="form-title"><i class="bi bi-pencil-square me-2"></i>Add CV</h2>

  <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="mb-4 input-icon-wrapper">
      <label for="full_name">Họ tên <span class="text-danger">*</span></label>
      <i class="bi bi-person-fill input-icon"></i>
      <input
        type="text"
        id="full_name"
        name="full_name"
        class="@error('full_name') is-invalid @enderror"
        placeholder="Nhập họ tên của bạn"
        value="{{ old('full_name') }}"
        autofocus
        required
      >
      @error('full_name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4 input-icon-wrapper">
      <label for="birth_year">Năm sinh <span class="text-danger">*</span></label>
      <i class="bi bi-calendar3 input-icon"></i>
      <input
        type="number"
        id="birth_year"
        name="birth_year"
        class="@error('birth_year') is-invalid @enderror"
        placeholder="Ví dụ: 1990"
        value="{{ old('birth_year') }}"
        min="1900"
        max="2100"
        required
      >
      @error('birth_year')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4 input-icon-wrapper">
      <label for="last_company">Công ty gần nhất</label>
      <i class="bi bi-building input-icon"></i>
      <input
        type="text"
        id="last_company"
        name="last_company"
        class="@error('last_company') is-invalid @enderror"
        placeholder="Tên công ty làm việc gần nhất"
        value="{{ old('last_company') }}"
      >
      @error('last_company')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4 input-icon-wrapper">
      <label for="last_position">Chức danh gần nhất</label>
      <i class="bi bi-person-badge input-icon"></i>
      <input
        type="text"
        id="last_position"
        name="last_position"
        class="@error('last_position') is-invalid @enderror"
        placeholder="Chức danh bạn đảm nhiệm"
        value="{{ old('last_position') }}"
      >
      @error('last_position')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4 input-icon-wrapper">
      <label for="cv">Tải CV <span class="text-danger">*</span></label>
      <i class="bi bi-file-earmark-arrow-up-fill input-icon"></i>
      <input
        type="file"
        id="cv"
        name="cv"
        class="@error('cv') is-invalid @enderror"
        accept=".pdf,.doc,.docx"
        required
      >
      <div class="form-text">Chỉ chấp nhận file PDF, DOC hoặc DOCX. Dung lượng tối đa 5MB.</div>
      @error('cv')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-submit">
      <i class="bi bi-send-fill me-2"></i> Add To Job
    </button>
  </form>
</div>
@endsection
