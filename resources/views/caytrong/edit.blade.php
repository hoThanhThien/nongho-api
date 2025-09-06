@extends('layouts.app')

@section('title', 'Chỉnh sửa Cây trồng')
@section('page-title', 'Chỉnh sửa Cây trồng: ' . $caytrong->ten_cay)

@section('content')
    @include('components.breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Cây trồng', 'url' => route('caytrong.index')],
            ['title' => 'Chỉnh sửa', 'url' => ''],
        ]
    ])

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa thông tin Cây trồng
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('caytrong.update', $caytrong) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ten_cay" class="form-label">
                                    <i class="fas fa-seedling me-1"></i>Tên cây trồng <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('ten_cay') is-invalid @enderror" 
                                       id="ten_cay" 
                                       name="ten_cay" 
                                       value="{{ old('ten_cay', $caytrong->ten_cay) }}"
                                       placeholder="Nhập tên cây trồng"
                                       required>
                                @error('ten_cay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="loai_cay" class="form-label">
                                    <i class="fas fa-tags me-1"></i>Loại cây <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('loai_cay') is-invalid @enderror" 
                                        id="loai_cay" 
                                        name="loai_cay" 
                                        required>
                                    <option value="">Chọn loại cây</option>
                                    <option value="lúa" {{ old('loai_cay', $caytrong->loai_cay) === 'lúa' ? 'selected' : '' }}>Lúa</option>
                                    <option value="ngô" {{ old('loai_cay', $caytrong->loai_cay) === 'ngô' ? 'selected' : '' }}>Ngô</option>
                                    <option value="khoai_lang" {{ old('loai_cay', $caytrong->loai_cay) === 'khoai_lang' ? 'selected' : '' }}>Khoai lang</option>
                                    <option value="đậu_phộng" {{ old('loai_cay', $caytrong->loai_cay) === 'đậu_phộng' ? 'selected' : '' }}>Đậu phộng</option>
                                    <option value="cà_chua" {{ old('loai_cay', $caytrong->loai_cay) === 'cà_chua' ? 'selected' : '' }}>Cà chua</option>
                                    <option value="rau_muống" {{ old('loai_cay', $caytrong->loai_cay) === 'rau_muống' ? 'selected' : '' }}>Rau muống</option>
                                    <option value="khác" {{ old('loai_cay', $caytrong->loai_cay) === 'khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('loai_cay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="giong" class="form-label">
                                    <i class="fas fa-dna me-1"></i>Giống cây trồng
                                </label>
                                <input type="text" 
                                       class="form-control @error('giong') is-invalid @enderror" 
                                       id="giong" 
                                       name="giong" 
                                       value="{{ old('giong', $caytrong->giong) }}"
                                       placeholder="Nhập tên giống cây (ví dụ: IR64, Jasmine, OM 5451...)">
                                @error('giong')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Nhập tên giống cây trồng cụ thể nếu có</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="thua_dat_id" class="form-label">
                                    <i class="fas fa-map me-1"></i>Thửa đất <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('thua_dat_id') is-invalid @enderror" 
                                        id="thua_dat_id" 
                                        name="thua_dat_id" 
                                        required>
                                    <option value="">Chọn thửa đất</option>
                                    @foreach($thuaDats as $thuaDat)
                                        <option value="{{ $thuaDat->id }}" 
                                                {{ old('thua_dat_id', $caytrong->thua_dat_id) == $thuaDat->id ? 'selected' : '' }}>
                                            {{ $thuaDat->ten_thua_dat }} 
                                            ({{ number_format($thuaDat->dien_tich, 2) }}m² - 
                                            {{ $thuaDat->nongHo->ten ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('thua_dat_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="dien_tich" class="form-label">
                                    <i class="fas fa-ruler-combined me-1"></i>Diện tích (m²) <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('dien_tich') is-invalid @enderror" 
                                       id="dien_tich" 
                                       name="dien_tich" 
                                       value="{{ old('dien_tich', $caytrong->dien_tich) }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="Nhập diện tích"
                                       required>
                                @error('dien_tich')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ngay_trong" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Ngày trồng
                                </label>
                                <input type="date" 
                                       class="form-control @error('ngay_trong') is-invalid @enderror" 
                                       id="ngay_trong" 
                                       name="ngay_trong" 
                                       value="{{ old('ngay_trong', $caytrong->ngay_trong ? $caytrong->ngay_trong->format('Y-m-d') : '') }}">
                                @error('ngay_trong')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="trang_thai" class="form-label">
                                    <i class="fas fa-info-circle me-1"></i>Trạng thái
                                </label>
                                <select class="form-select @error('trang_thai') is-invalid @enderror" 
                                        id="trang_thai" 
                                        name="trang_thai">
                                    <option value="đang_phát_triển" {{ old('trang_thai', $caytrong->trang_thai) === 'đang_phát_triển' ? 'selected' : '' }}>
                                        Đang phát triển
                                    </option>
                                    <option value="thu_hoạch" {{ old('trang_thai', $caytrong->trang_thai) === 'thu_hoạch' ? 'selected' : '' }}>
                                        Thu hoạch
                                    </option>
                                    <option value="hoàn_thành" {{ old('trang_thai', $caytrong->trang_thai) === 'hoàn_thành' ? 'selected' : '' }}>
                                        Hoàn thành
                                    </option>
                                </select>
                                @error('trang_thai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ghi_chu" class="form-label">
                                <i class="fas fa-sticky-note me-1"></i>Ghi chú
                            </label>
                            <textarea class="form-control @error('ghi_chu') is-invalid @enderror" 
                                      id="ghi_chu" 
                                      name="ghi_chu" 
                                      rows="3"
                                      placeholder="Nhập ghi chú về cây trồng (tùy chọn)">{{ old('ghi_chu', $caytrong->ghi_chu) }}</textarea>
                            @error('ghi_chu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('caytrong.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-warning me-2">
                                    <i class="fas fa-undo me-2"></i>Đặt lại
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-2"></i>Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.loading-spinner')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-calculate area based on selected land plot
        const thuaDatSelect = document.getElementById('thua_dat_id');
        const dienTichInput = document.getElementById('dien_tich');
        
        function updateAreaConstraints() {
            const selectedOption = thuaDatSelect.options[thuaDatSelect.selectedIndex];
            if (selectedOption.value) {
                const text = selectedOption.textContent;
                const areaMatch = text.match(/\(([\d,\.]+)m²/);
                if (areaMatch) {
                    const maxArea = parseFloat(areaMatch[1].replace(/,/g, ''));
                    dienTichInput.setAttribute('max', maxArea);
                    
                    // Show warning if current value exceeds max
                    dienTichInput.addEventListener('input', function() {
                        const currentValue = parseFloat(this.value);
                        if (currentValue > maxArea) {
                            this.setCustomValidity(`Diện tích không được vượt quá ${maxArea}m²`);
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                }
            }
        }
        
        // Initialize on page load
        updateAreaConstraints();
        
        // Update when selection changes
        thuaDatSelect.addEventListener('change', updateAreaConstraints);
    });
</script>
@endsection
