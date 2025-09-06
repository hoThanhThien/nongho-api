@extends('layouts.app')

@section('title', 'Thêm Nông hộ mới')
@section('page-title', 'Thêm Nông hộ mới')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('nongho.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="ten" class="form-label">Tên chủ hộ <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('ten') is-invalid @enderror" 
                                   id="ten" 
                                   name="ten" 
                                   value="{{ old('ten') }}" 
                                   required
                                   placeholder="Nhập tên chủ hộ...">
                            @error('ten')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa chỉ</label>
                            <textarea class="form-control @error('dia_chi') is-invalid @enderror" 
                                      id="dia_chi" 
                                      name="dia_chi" 
                                      rows="3"
                                      placeholder="Nhập địa chỉ đầy đủ (tùy chọn)">{{ old('dia_chi') }}</textarea>
                            @error('dia_chi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                <input type="tel" 
                                       class="form-control @error('so_dien_thoai') is-invalid @enderror" 
                                       id="so_dien_thoai" 
                                       name="so_dien_thoai" 
                                       value="{{ old('so_dien_thoai') }}"
                                       placeholder="Nhập số điện thoại">
                                @error('so_dien_thoai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="Nhập địa chỉ email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Lưu
                            </button>
                            <a href="{{ route('nongho.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
