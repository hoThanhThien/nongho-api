@extends('layouts.app')

@section('title', 'Chi tiết Thửa đất')
@section('page-title', 'Chi tiết Thửa đất: ' . $thuadat->ten_thua)

@section('page-actions')
    <a href="{{ route('thuadat.edit', $thuadat) }}" class="btn btn-warning">
        <i class="fas fa-edit me-2"></i>Chỉnh sửa
    </a>
    <button type="button" class="btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#addCayTrongOffcanvas">
        <i class="fas fa-seedling me-2"></i>Thêm Cây trồng
    </button>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Thửa đất</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Tên thửa:</dt>
                        <dd class="col-sm-7">{{ $thuadat->ten_thua }}</dd>
                        
                        <dt class="col-sm-5">Diện tích:</dt>
                        <dd class="col-sm-7">{{ number_format($thuadat->dien_tich, 2) }} m²</dd>
                        
                        <dt class="col-sm-5">Nông hộ:</dt>
                        <dd class="col-sm-7">
                            <a href="{{ route('nongho.show', $thuadat->nongHo) }}" class="text-decoration-none">
                                {{ $thuadat->nongHo->ten }}
                            </a>
                            @if($thuadat->nongHo->so_dien_thoai)
                                <br><small class="text-muted">
                                    <i class="fas fa-phone me-1"></i>{{ $thuadat->nongHo->so_dien_thoai }}
                                </small>
                            @endif
                        </dd>
                        
                        <dt class="col-sm-5">Ngày tạo:</dt>
                        <dd class="col-sm-7">{{ $thuadat->created_at->format('d/m/Y H:i') }}</dd>
                        
                        <dt class="col-sm-5">Số cây trồng:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-success">{{ $thuadat->cayTrongs->count() }} loại</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Danh sách Cây trồng</h5>
                </div>
                <div class="card-body">
                    @if($thuadat->cayTrongs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên cây trồng</th>
                                        <th>Giống</th>
                                        <th>Diện tích</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($thuadat->cayTrongs as $index => $caytrong)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $caytrong->ten_cay }}</td>
                                            <td>{{ $caytrong->giong ?: 'Không xác định' }}</td>
                                            <td>{{ number_format($caytrong->dien_tich, 2) }} m²</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                                            data-bs-toggle="offcanvas" 
                                                            data-bs-target="#editCayTrongOffcanvas{{ $caytrong->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('caytrong.destroy', $caytrong) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa cây trồng này?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-seedling fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Chưa có cây trồng nào</h5>
                            <p class="text-muted">Hãy thêm cây trồng đầu tiên cho thửa đất này!</p>
                            <button type="button" class="btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#addCayTrongOffcanvas">
                                <i class="fas fa-plus me-2"></i>Thêm Cây trồng
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Cay Trong Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addCayTrongOffcanvas" aria-labelledby="addCayTrongOffcanvasLabel">
        <div class="offcanvas-header bg-success text-white">
            <h5 class="offcanvas-title" id="addCayTrongOffcanvasLabel">
                <i class="fas fa-seedling me-2"></i>Thêm Cây trồng mới
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('caytrong.store') }}" method="POST">
                @csrf
                <input type="hidden" name="thua_dat_id" value="{{ $thuadat->id }}">
                
                <div class="mb-3">
                    <label for="ten_cay" class="form-label">Tên cây trồng <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ten_cay" name="ten_cay" required placeholder="Nhập tên cây trồng">
                </div>
                
                <div class="mb-3">
                    <label for="loai_cay" class="form-label">Loại cây <span class="text-danger">*</span></label>
                    <select class="form-select" id="loai_cay" name="loai_cay" required>
                        <option value="">Chọn loại cây</option>
                        <optgroup label="Cây lương thực">
                            <option value="lúa">Lúa</option>
                            <option value="ngô">Ngô</option>
                            <option value="khoai_lang">Khoai lang</option>
                            <option value="khoai_tây">Khoai tây</option>
                            <option value="sắn">Sắn/Khoai mì</option>
                            <option value="khoai_môn">Khoai môn</option>
                        </optgroup>
                        <optgroup label="Cây đậu">
                            <option value="đậu_phộng">Đậu phộng</option>
                            <option value="đậu_xanh">Đậu xanh</option>
                            <option value="đậu_đỏ">Đậu đỏ</option>
                            <option value="đậu_tương">Đậu tương</option>
                            <option value="đậu_que">Đậu que</option>
                            <option value="đậu_cove">Đậu cove</option>
                        </optgroup>
                        <optgroup label="Rau ăn lá">
                            <option value="rau_muống">Rau muống</option>
                            <option value="rau_cải">Rau cải</option>
                            <option value="cải_bắp">Cải bắp</option>
                            <option value="xà_lách">Xà lách</option>
                            <option value="rau_dền">Rau dền</option>
                            <option value="rau_lang">Rau lang</option>
                            <option value="rau_ngót">Rau ngót</option>
                            <option value="cải_thảo">Cải thảo</option>
                            <option value="cải_xoong">Cải xoong</option>
                        </optgroup>
                        <optgroup label="Rau ăn quả">
                            <option value="cà_chua">Cà chua</option>
                            <option value="cà_tím">Cà tím</option>
                            <option value="ớt">Ớt</option>
                            <option value="dưa_chuột">Dưa chuột</option>
                            <option value="bí_ngô">Bí ngô</option>
                            <option value="bí_đao">Bí đao</option>
                            <option value="mướp">Mướp</option>
                            <option value="khổ_qua">Khổ qua</option>
                            <option value="đậu_bắp">Đậu bắp</option>
                            <option value="su_hào">Su hào</option>
                        </optgroup>
                        <optgroup label="Cây gia vị">
                            <option value="hành_lá">Hành lá</option>
                            <option value="tỏi">Tỏi</option>
                            <option value="gừng">Gừng</option>
                            <option value="sả">Sả</option>
                            <option value="nghệ">Nghệ</option>
                            <option value="riềng">Riềng</option>
                            <option value="húng_quế">Húng quế</option>
                            <option value="ngò">Ngò</option>
                        </optgroup>
                        <optgroup label="Cây ăn quả">
                            <option value="xoài">Xoài</option>
                            <option value="chuối">Chuối</option>
                            <option value="cam">Cam</option>
                            <option value="bưởi">Bưởi</option>
                            <option value="đu_đủ">Đu đủ</option>
                            <option value="mít">Mít</option>
                            <option value="dừa">Dừa</option>
                            <option value="chôm_chôm">Chôm chôm</option>
                            <option value="vải">Vải</option>
                            <option value="nhãn">Nhãn</option>
                            <option value="mãng_cầu">Mãng cầu</option>
                            <option value="sầu_riêng">Sầu riêng</option>
                            <option value="măng_cụt">Măng cụt</option>
                            <option value="thanh_long">Thanh long</option>
                            <option value="nho">Nho</option>
                        </optgroup>
                        <optgroup label="Cây lâu năm">
                            <option value="tre_luồng">Tre luồng</option>
                            <option value="tre_gai">Tre gai</option>
                            <option value="keo">Keo</option>
                            <option value="bạch_đàn">Bạch đàn</option>
                            <option value="thông">Thông</option>
                            <option value="sa_mu">Sa mu</option>
                            <option value="lim">Lim</option>
                            <option value="gỗ_lát">Gỗ lát</option>
                        </optgroup>
                        <optgroup label="Cây công nghiệp">
                            <option value="mía">Mía</option>
                            <option value="cà_phê">Cà phê</option>
                            <option value="cao_su">Cao su</option>
                            <option value="tiêu">Tiêu</option>
                            <option value="điều">Điều</option>
                            <option value="chè">Chè</option>
                            <option value="thuốc_lá">Thuốc lá</option>
                            <option value="bông">Bông</option>
                            <option value="dâu_tằm">Dâu tằm</option>
                            <option value="cọ_dầu">Cọ dầu</option>
                        </optgroup>
                        <optgroup label="Cây thảo dược">
                            <option value="lô_hội">Lô hội</option>
                            <option value="cỏ_ngọt">Cỏ ngọt</option>
                            <option value="atiso">Atiso</option>
                            <option value="đậu_biếc">Đậu biếc</option>
                            <option value="lá_lốt">Lá lốt</option>
                        </optgroup>
                        <option value="khác">Khác</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="giong" class="form-label">Giống cây trồng</label>
                    <input type="text" class="form-control" id="giong" name="giong" placeholder="Nhập tên giống cây...">
                    <div class="form-text">Ví dụ: ST25, Jasmine 85, LVN 10...</div>
                </div>
                
                <div class="mb-3">
                    <label for="dien_tich" class="form-label">Diện tích (m²) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="dien_tich" name="dien_tich" step="0.01" min="0" max="{{ $thuadat->dien_tich }}" required placeholder="Nhập diện tích">
                    <div class="form-text">Tối đa {{ number_format($thuadat->dien_tich, 2) }} m² (diện tích thửa đất)</div>
                </div>
                
                <div class="mb-3">
                    <label for="ngay_trong" class="form-label">Ngày trồng</label>
                    <input type="date" class="form-control" id="ngay_trong" name="ngay_trong" value="{{ now()->format('Y-m-d') }}">
                </div>
                
                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai">
                        <option value="đang_phát_triển" selected>Đang phát triển</option>
                        <option value="thu_hoạch">Thu hoạch</option>
                        <option value="hoàn_thành">Hoàn thành</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="ghi_chu" class="form-label">Ghi chú</label>
                    <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3" placeholder="Nhập ghi chú về cây trồng (tùy chọn)"></textarea>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Lưu cây trồng
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                        <i class="fas fa-times me-2"></i>Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Offcanvas for each cay trong -->
    @if($thuadat->cayTrongs->count() > 0)
        @foreach($thuadat->cayTrongs as $caytrong)
            <div class="offcanvas offcanvas-end" tabindex="-1" id="editCayTrongOffcanvas{{ $caytrong->id }}" aria-labelledby="editCayTrongOffcanvasLabel{{ $caytrong->id }}">
                <div class="offcanvas-header bg-primary text-white">
                    <h5 class="offcanvas-title" id="editCayTrongOffcanvasLabel{{ $caytrong->id }}">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa: {{ $caytrong->ten_cay }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('caytrong.update', $caytrong) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="thua_dat_id" value="{{ $thuadat->id }}">
                        
                        <div class="mb-3">
                            <label for="ten_cay_edit_{{ $caytrong->id }}" class="form-label">Tên cây trồng <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ten_cay_edit_{{ $caytrong->id }}" name="ten_cay" value="{{ $caytrong->ten_cay }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="loai_cay_edit_{{ $caytrong->id }}" class="form-label">Loại cây <span class="text-danger">*</span></label>
                            <select class="form-select" id="loai_cay_edit_{{ $caytrong->id }}" name="loai_cay" required>
                                <option value="">Chọn loại cây</option>
                                <optgroup label="Cây lương thực">
                                    <option value="lúa" {{ $caytrong->loai_cay === 'lúa' ? 'selected' : '' }}>Lúa</option>
                                    <option value="ngô" {{ $caytrong->loai_cay === 'ngô' ? 'selected' : '' }}>Ngô</option>
                                    <option value="khoai_lang" {{ $caytrong->loai_cay === 'khoai_lang' ? 'selected' : '' }}>Khoai lang</option>
                                    <option value="khoai_tây" {{ $caytrong->loai_cay === 'khoai_tây' ? 'selected' : '' }}>Khoai tây</option>
                                    <option value="sắn" {{ $caytrong->loai_cay === 'sắn' ? 'selected' : '' }}>Sắn/Khoai mì</option>
                                    <option value="khoai_môn" {{ $caytrong->loai_cay === 'khoai_môn' ? 'selected' : '' }}>Khoai môn</option>
                                </optgroup>
                                <optgroup label="Cây đậu">
                                    <option value="đậu_phộng" {{ $caytrong->loai_cay === 'đậu_phộng' ? 'selected' : '' }}>Đậu phộng</option>
                                    <option value="đậu_xanh" {{ $caytrong->loai_cay === 'đậu_xanh' ? 'selected' : '' }}>Đậu xanh</option>
                                    <option value="đậu_đỏ" {{ $caytrong->loai_cay === 'đậu_đỏ' ? 'selected' : '' }}>Đậu đỏ</option>
                                    <option value="đậu_tương" {{ $caytrong->loai_cay === 'đậu_tương' ? 'selected' : '' }}>Đậu tương</option>
                                    <option value="đậu_que" {{ $caytrong->loai_cay === 'đậu_que' ? 'selected' : '' }}>Đậu que</option>
                                    <option value="đậu_cove" {{ $caytrong->loai_cay === 'đậu_cove' ? 'selected' : '' }}>Đậu cove</option>
                                </optgroup>
                                <optgroup label="Rau ăn lá">
                                    <option value="rau_muống" {{ $caytrong->loai_cay === 'rau_muống' ? 'selected' : '' }}>Rau muống</option>
                                    <option value="rau_cải" {{ $caytrong->loai_cay === 'rau_cải' ? 'selected' : '' }}>Rau cải</option>
                                    <option value="cải_bắp" {{ $caytrong->loai_cay === 'cải_bắp' ? 'selected' : '' }}>Cải bắp</option>
                                    <option value="xà_lách" {{ $caytrong->loai_cay === 'xà_lách' ? 'selected' : '' }}>Xà lách</option>
                                    <option value="rau_dền" {{ $caytrong->loai_cay === 'rau_dền' ? 'selected' : '' }}>Rau dền</option>
                                    <option value="rau_lang" {{ $caytrong->loai_cay === 'rau_lang' ? 'selected' : '' }}>Rau lang</option>
                                    <option value="rau_ngót" {{ $caytrong->loai_cay === 'rau_ngót' ? 'selected' : '' }}>Rau ngót</option>
                                    <option value="cải_thảo" {{ $caytrong->loai_cay === 'cải_thảo' ? 'selected' : '' }}>Cải thảo</option>
                                    <option value="cải_xoong" {{ $caytrong->loai_cay === 'cải_xoong' ? 'selected' : '' }}>Cải xoong</option>
                                </optgroup>
                                <optgroup label="Rau ăn quả">
                                    <option value="cà_chua" {{ $caytrong->loai_cay === 'cà_chua' ? 'selected' : '' }}>Cà chua</option>
                                    <option value="cà_tím" {{ $caytrong->loai_cay === 'cà_tím' ? 'selected' : '' }}>Cà tím</option>
                                    <option value="ớt" {{ $caytrong->loai_cay === 'ớt' ? 'selected' : '' }}>Ớt</option>
                                    <option value="dưa_chuột" {{ $caytrong->loai_cay === 'dưa_chuột' ? 'selected' : '' }}>Dưa chuột</option>
                                    <option value="bí_ngô" {{ $caytrong->loai_cay === 'bí_ngô' ? 'selected' : '' }}>Bí ngô</option>
                                    <option value="bí_đao" {{ $caytrong->loai_cay === 'bí_đao' ? 'selected' : '' }}>Bí đao</option>
                                    <option value="mướp" {{ $caytrong->loai_cay === 'mướp' ? 'selected' : '' }}>Mướp</option>
                                    <option value="khổ_qua" {{ $caytrong->loai_cay === 'khổ_qua' ? 'selected' : '' }}>Khổ qua</option>
                                    <option value="đậu_bắp" {{ $caytrong->loai_cay === 'đậu_bắp' ? 'selected' : '' }}>Đậu bắp</option>
                                    <option value="su_hào" {{ $caytrong->loai_cay === 'su_hào' ? 'selected' : '' }}>Su hào</option>
                                </optgroup>
                                <optgroup label="Cây gia vị">
                                    <option value="hành_lá" {{ $caytrong->loai_cay === 'hành_lá' ? 'selected' : '' }}>Hành lá</option>
                                    <option value="tỏi" {{ $caytrong->loai_cay === 'tỏi' ? 'selected' : '' }}>Tỏi</option>
                                    <option value="gừng" {{ $caytrong->loai_cay === 'gừng' ? 'selected' : '' }}>Gừng</option>
                                    <option value="sả" {{ $caytrong->loai_cay === 'sả' ? 'selected' : '' }}>Sả</option>
                                    <option value="nghệ" {{ $caytrong->loai_cay === 'nghệ' ? 'selected' : '' }}>Nghệ</option>
                                    <option value="riềng" {{ $caytrong->loai_cay === 'riềng' ? 'selected' : '' }}>Riềng</option>
                                    <option value="húng_quế" {{ $caytrong->loai_cay === 'húng_quế' ? 'selected' : '' }}>Húng quế</option>
                                    <option value="ngò" {{ $caytrong->loai_cay === 'ngò' ? 'selected' : '' }}>Ngò</option>
                                </optgroup>
                                <optgroup label="Cây ăn quả">
                                    <option value="xoài" {{ $caytrong->loai_cay === 'xoài' ? 'selected' : '' }}>Xoài</option>
                                    <option value="chuối" {{ $caytrong->loai_cay === 'chuối' ? 'selected' : '' }}>Chuối</option>
                                    <option value="cam" {{ $caytrong->loai_cay === 'cam' ? 'selected' : '' }}>Cam</option>
                                    <option value="bưởi" {{ $caytrong->loai_cay === 'bưởi' ? 'selected' : '' }}>Bưởi</option>
                                    <option value="đu_đủ" {{ $caytrong->loai_cay === 'đu_đủ' ? 'selected' : '' }}>Đu đủ</option>
                                    <option value="mít" {{ $caytrong->loai_cay === 'mít' ? 'selected' : '' }}>Mít</option>
                                    <option value="dừa" {{ $caytrong->loai_cay === 'dừa' ? 'selected' : '' }}>Dừa</option>
                                    <option value="chôm_chôm" {{ $caytrong->loai_cay === 'chôm_chôm' ? 'selected' : '' }}>Chôm chôm</option>
                                    <option value="vải" {{ $caytrong->loai_cay === 'vải' ? 'selected' : '' }}>Vải</option>
                                    <option value="nhãn" {{ $caytrong->loai_cay === 'nhãn' ? 'selected' : '' }}>Nhãn</option>
                                    <option value="mãng_cầu" {{ $caytrong->loai_cay === 'mãng_cầu' ? 'selected' : '' }}>Mãng cầu</option>
                                    <option value="sầu_riêng" {{ $caytrong->loai_cay === 'sầu_riêng' ? 'selected' : '' }}>Sầu riêng</option>
                                    <option value="măng_cụt" {{ $caytrong->loai_cay === 'măng_cụt' ? 'selected' : '' }}>Măng cụt</option>
                                    <option value="thanh_long" {{ $caytrong->loai_cay === 'thanh_long' ? 'selected' : '' }}>Thanh long</option>
                                    <option value="nho" {{ $caytrong->loai_cay === 'nho' ? 'selected' : '' }}>Nho</option>
                                </optgroup>
                                <optgroup label="Cây lâu năm">
                                    <option value="tre_luồng" {{ $caytrong->loai_cay === 'tre_luồng' ? 'selected' : '' }}>Tre luồng</option>
                                    <option value="tre_gai" {{ $caytrong->loai_cay === 'tre_gai' ? 'selected' : '' }}>Tre gai</option>
                                    <option value="keo" {{ $caytrong->loai_cay === 'keo' ? 'selected' : '' }}>Keo</option>
                                    <option value="bạch_đàn" {{ $caytrong->loai_cay === 'bạch_đàn' ? 'selected' : '' }}>Bạch đàn</option>
                                    <option value="thông" {{ $caytrong->loai_cay === 'thông' ? 'selected' : '' }}>Thông</option>
                                    <option value="sa_mu" {{ $caytrong->loai_cay === 'sa_mu' ? 'selected' : '' }}>Sa mu</option>
                                    <option value="lim" {{ $caytrong->loai_cay === 'lim' ? 'selected' : '' }}>Lim</option>
                                    <option value="gỗ_lát" {{ $caytrong->loai_cay === 'gỗ_lát' ? 'selected' : '' }}>Gỗ lát</option>
                                </optgroup>
                                <optgroup label="Cây công nghiệp">
                                    <option value="mía" {{ $caytrong->loai_cay === 'mía' ? 'selected' : '' }}>Mía</option>
                                    <option value="cà_phê" {{ $caytrong->loai_cay === 'cà_phê' ? 'selected' : '' }}>Cà phê</option>
                                    <option value="cao_su" {{ $caytrong->loai_cay === 'cao_su' ? 'selected' : '' }}>Cao su</option>
                                    <option value="tiêu" {{ $caytrong->loai_cay === 'tiêu' ? 'selected' : '' }}>Tiêu</option>
                                    <option value="điều" {{ $caytrong->loai_cay === 'điều' ? 'selected' : '' }}>Điều</option>
                                    <option value="chè" {{ $caytrong->loai_cay === 'chè' ? 'selected' : '' }}>Chè</option>
                                    <option value="thuốc_lá" {{ $caytrong->loai_cay === 'thuốc_lá' ? 'selected' : '' }}>Thuốc lá</option>
                                    <option value="bông" {{ $caytrong->loai_cay === 'bông' ? 'selected' : '' }}>Bông</option>
                                    <option value="dâu_tằm" {{ $caytrong->loai_cay === 'dâu_tằm' ? 'selected' : '' }}>Dâu tằm</option>
                                    <option value="cọ_dầu" {{ $caytrong->loai_cay === 'cọ_dầu' ? 'selected' : '' }}>Cọ dầu</option>
                                </optgroup>
                                <optgroup label="Cây thảo dược">
                                    <option value="lô_hội" {{ $caytrong->loai_cay === 'lô_hội' ? 'selected' : '' }}>Lô hội</option>
                                    <option value="cỏ_ngọt" {{ $caytrong->loai_cay === 'cỏ_ngọt' ? 'selected' : '' }}>Cỏ ngọt</option>
                                    <option value="atiso" {{ $caytrong->loai_cay === 'atiso' ? 'selected' : '' }}>Atiso</option>
                                    <option value="đậu_biếc" {{ $caytrong->loai_cay === 'đậu_biếc' ? 'selected' : '' }}>Đậu biếc</option>
                                    <option value="lá_lốt" {{ $caytrong->loai_cay === 'lá_lốt' ? 'selected' : '' }}>Lá lốt</option>
                                </optgroup>
                                <option value="khác" {{ $caytrong->loai_cay === 'khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="giong_edit_{{ $caytrong->id }}" class="form-label">Giống cây trồng</label>
                            <input type="text" class="form-control" id="giong_edit_{{ $caytrong->id }}" name="giong" value="{{ $caytrong->giong }}" placeholder="Nhập tên giống cây...">
                            <div class="form-text">Ví dụ: ST25, Jasmine 85, LVN 10...</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dien_tich_edit_{{ $caytrong->id }}" class="form-label">Diện tích (m²) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="dien_tich_edit_{{ $caytrong->id }}" name="dien_tich" value="{{ $caytrong->dien_tich }}" step="0.01" min="0" max="{{ $thuadat->dien_tich }}" required>
                            <div class="form-text">Tối đa {{ number_format($thuadat->dien_tich, 2) }} m²</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ngay_trong_edit_{{ $caytrong->id }}" class="form-label">Ngày trồng</label>
                            <input type="date" class="form-control" id="ngay_trong_edit_{{ $caytrong->id }}" name="ngay_trong" value="{{ $caytrong->ngay_trong ? $caytrong->ngay_trong->format('Y-m-d') : '' }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="trang_thai_edit_{{ $caytrong->id }}" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai_edit_{{ $caytrong->id }}" name="trang_thai">
                                <option value="đang_phát_triển" {{ $caytrong->trang_thai === 'đang_phát_triển' ? 'selected' : '' }}>Đang phát triển</option>
                                <option value="thu_hoạch" {{ $caytrong->trang_thai === 'thu_hoạch' ? 'selected' : '' }}>Thu hoạch</option>
                                <option value="hoàn_thành" {{ $caytrong->trang_thai === 'hoàn_thành' ? 'selected' : '' }}>Hoàn thành</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ghi_chu_edit_{{ $caytrong->id }}" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="ghi_chu_edit_{{ $caytrong->id }}" name="ghi_chu" rows="3" placeholder="Nhập ghi chú về cây trồng (tùy chọn)">{{ $caytrong->ghi_chu }}</textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Cập nhật
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                                <i class="fas fa-times me-2"></i>Hủy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Always define maxArea at the top to avoid JS errors
    const maxArea = parseFloat("{{ $thuadat->dien_tich ?? 0 }}") || 0;
    console.log('Max area loaded:', maxArea);
    
    // Simple form validation on submit
    document.addEventListener('submit', function(e) {
        if (e.target.action && e.target.action.includes('caytrong')) {
            const areaInput = e.target.querySelector('input[name="dien_tich"]');
            if (areaInput) {
                const inputValue = parseFloat(areaInput.value);
                
                if (isNaN(inputValue) || inputValue <= 0) {
                    e.preventDefault();
                    alert('Vui lòng nhập diện tích hợp lệ (lớn hơn 0)');
                    areaInput.focus();
                    return false;
                }
                
                if (inputValue > maxArea) {
                    e.preventDefault();
                    alert('Diện tích không được vượt quá ' + maxArea.toFixed(2) + 'm²');
                    areaInput.focus();
                    return false;
                }
            }
        }
    });
    
    // Reset form when add offcanvas closes
    const addOffcanvas = document.getElementById('addCayTrongOffcanvas');
    if (addOffcanvas) {
        addOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
            const form = addOffcanvas.querySelector('form');
            if (form) {
                form.reset();
                // Set today's date
                const dateInput = form.querySelector('input[name="ngay_trong"]');
                if (dateInput) {
                    const today = new Date();
                    const dateStr = today.getFullYear() + '-' + 
                                  String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                                  String(today.getDate()).padStart(2, '0');
                    dateInput.value = dateStr;
                }
            }
        });
    }
    
    // Auto focus when offcanvas opens
    document.querySelectorAll('.offcanvas').forEach(function(offcanvas) {
        offcanvas.addEventListener('shown.bs.offcanvas', function() {
            const firstInput = this.querySelector('input[type="text"], input[type="number"], select, textarea');
            if (firstInput) {
                firstInput.focus();
            }
        });
    });
});
</script>
@endsection
