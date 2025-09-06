@extends('layouts.app')

@section('title', 'Thêm Thửa đất mới')
@section('page-title', 'Thêm Thửa đất mới')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('thuadat.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="ten_thua" class="form-label">Tên Thửa đất <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('ten_thua') is-invalid @enderror" 
                                   id="ten_thua" 
                                   name="ten_thua" 
                                   value="{{ old('ten_thua') }}" 
                                   required
                                   placeholder="Nhập tên thửa đất...">
                            @error('ten_thua')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="dien_tich" class="form-label">Diện tích (m²) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   step="0.01"
                                   min="0"
                                   class="form-control @error('dien_tich') is-invalid @enderror" 
                                   id="dien_tich" 
                                   name="dien_tich" 
                                   value="{{ old('dien_tich') }}" 
                                   required
                                   placeholder="Nhập diện tích...">
                            @error('dien_tich')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="nongho_id" class="form-label">Nông hộ sở hữu <span class="text-danger">*</span></label>
                            <select class="form-select @error('nongho_id') is-invalid @enderror" 
                                    id="nongho_id" 
                                    name="nongho_id" 
                                    required>
                                <option value="">-- Chọn nông hộ --</option>
                                @foreach($nongHos as $nongho)
                                    <option value="{{ $nongho->id }}" {{ old('nongho_id', request('nongho_id')) == $nongho->id ? 'selected' : '' }}>
                                        {{ $nongho->ten }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nongho_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Lưu
                            </button>
                            <a href="{{ route('thuadat.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
