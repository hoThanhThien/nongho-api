<!-- Thửa đất Details Modal -->
<div class="modal fade" id="thuaDatDetailModal" tabindex="-1" aria-labelledby="thuaDatDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thuaDatDetailModalLabel">
                    <i class="fas fa-map me-2"></i>Chi tiết Thửa đất
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-section">
                            <h6 class="text-muted text-uppercase small mb-3">Thông tin Thửa đất</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td><strong>Tên thửa:</strong></td>
                                    <td id="detail-ten-thua"></td>
                                </tr>
                                <tr>
                                    <td><strong>Diện tích:</strong></td>
                                    <td id="detail-dien-tich"></td>
                                </tr>
                                <tr>
                                    <td><strong>Nông hộ:</strong></td>
                                    <td id="detail-nong-ho"></td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày tạo:</strong></td>
                                    <td id="detail-ngay-tao"></td>
                                </tr>
                                <tr>
                                    <td><strong>Số cây trồng:</strong></td>
                                    <td id="detail-so-cay-trong"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="crop-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-muted text-uppercase small mb-0">Cây trồng trên thửa đất</h6>
                                <button class="btn btn-success btn-sm" onclick="openAddCropModal()">
                                    <i class="fas fa-plus me-1"></i>Thêm Cây trồng
                                </button>
                            </div>
                            
                            <div id="crop-list">
                                <!-- Crops will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
                <button type="button" class="btn btn-warning" onclick="editThuaDat()">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Crop Modal -->
<div class="modal fade" id="addCropModal" tabindex="-1" aria-labelledby="addCropModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCropModalLabel">
                    <i class="fas fa-seedling me-2"></i>Thêm Cây trồng mới
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCropForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="crop-name" class="form-label">
                            <i class="fas fa-leaf me-1"></i>Tên cây trồng <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="crop-name" placeholder="Nhập tên cây trồng" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="crop-type" class="form-label">
                            <i class="fas fa-tags me-1"></i>Loại cây <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="crop-type" required>
                            <option value="">Chọn loại cây</option>
                            <option value="lúa">Lúa</option>
                            <option value="ngô">Ngô</option>
                            <option value="khoai_lang">Khoai lang</option>
                            <option value="đậu_phộng">Đậu phộng</option>
                            <option value="cà_chua">Cà chua</option>
                            <option value="rau_muống">Rau muống</option>
                            <option value="khác">Khác</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="crop-area" class="form-label">
                            <i class="fas fa-ruler-combined me-1"></i>Diện tích (m²) <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" id="crop-area" step="0.01" min="0" placeholder="Nhập diện tích" required>
                        <div class="form-text">Diện tích tối đa: <span id="max-area">0</span> m²</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="planting-date" class="form-label">
                            <i class="fas fa-calendar me-1"></i>Ngày trồng
                        </label>
                        <input type="date" class="form-control" id="planting-date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Hủy
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Thêm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentThuaDatId = null;
    
    function showThuaDatDetail(thuaDatId, data) {
        currentThuaDatId = thuaDatId;
        
        // Populate modal with data
        document.getElementById('detail-ten-thua').textContent = data.ten || 'N/A';
        document.getElementById('detail-dien-tich').textContent = data.dien_tich ? data.dien_tich + ' m²' : 'N/A';
        document.getElementById('detail-nong-ho').textContent = data.nong_ho || 'N/A';
        document.getElementById('detail-ngay-tao').textContent = data.ngay_tao || 'N/A';
        
        // Load crops for this thửa đất
        loadCropsForThuaDat(thuaDatId);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('thuaDatDetailModal'));
        modal.show();
    }
    
    function loadCropsForThuaDat(thuaDatId) {
        const cropList = document.getElementById('crop-list');
        
        // Sample crops data (in real app, this would be an AJAX call)
        const sampleCrops = [
            { id: 1, ten: 'Lúa tám xoan', loai: 'lúa', dien_tich: 200, ngay_trong: '2025-06-15', trang_thai: 'đang_phát_triển' },
            { id: 2, ten: 'Ngô bao tử', loai: 'ngô', dien_tich: 150, ngay_trong: '2025-07-01', trang_thai: 'thu_hoạch' }
        ];
        
        if (sampleCrops.length === 0) {
            cropList.innerHTML = `
                <div class="empty-state py-3">
                    <i class="fas fa-seedling empty-icon" style="font-size: 2rem; opacity: 0.5;"></i>
                    <p class="text-muted mt-2 mb-0">Thửa đất này chưa có cây trồng nào</p>
                    <small class="text-muted">Hãy thêm cây trồng đầu tiên cho thửa đất này!</small>
                </div>
            `;
        } else {
            let cropHtml = '';
            sampleCrops.forEach(crop => {
                const statusClass = crop.trang_thai === 'đang_phát_triển' ? 'success' : 'warning';
                const statusText = crop.trang_thai === 'đang_phát_triển' ? 'Đang phát triển' : 'Thu hoạch';
                
                cropHtml += `
                    <div class="crop-item border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${crop.ten}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-ruler me-1"></i>${crop.dien_tich} m²
                                    <i class="fas fa-calendar ms-2 me-1"></i>${crop.ngay_trong}
                                </small>
                            </div>
                            <span class="badge bg-${statusClass}">${statusText}</span>
                        </div>
                    </div>
                `;
            });
            cropList.innerHTML = cropHtml;
        }
        
        // Update crop count
        document.getElementById('detail-so-cay-trong').innerHTML = `
            <span class="badge bg-success">${sampleCrops.length} loại</span>
        `;
    }
    
    function openAddCropModal() {
        // Set max area based on current thửa đất
        document.getElementById('max-area').textContent = '500.00'; // Sample max area
        document.getElementById('crop-area').setAttribute('max', '500');
        
        // Set default planting date to today
        document.getElementById('planting-date').value = new Date().toISOString().split('T')[0];
        
        // Hide current modal and show add crop modal
        const currentModal = bootstrap.Modal.getInstance(document.getElementById('thuaDatDetailModal'));
        currentModal.hide();
        
        setTimeout(() => {
            const addCropModal = new bootstrap.Modal(document.getElementById('addCropModal'));
            addCropModal.show();
        }, 300);
    }
    
    function editThuaDat() {
        if (currentThuaDatId) {
            // In real app, redirect to edit page
            window.location.href = `/thuadat/${currentThuaDatId}/edit`;
        }
    }
    
    // Handle add crop form submission
    document.getElementById('addCropForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            name: document.getElementById('crop-name').value,
            type: document.getElementById('crop-type').value,
            area: document.getElementById('crop-area').value,
            planting_date: document.getElementById('planting-date').value,
            thua_dat_id: currentThuaDatId
        };
        
        // In real app, this would be an AJAX call
        console.log('Adding crop:', formData);
        
        // Show success message
        if (window.nonghoApp) {
            window.nonghoApp.showNotification('Đã thêm cây trồng thành công!', 'success');
        }
        
        // Close modal and refresh data
        const modal = bootstrap.Modal.getInstance(document.getElementById('addCropModal'));
        modal.hide();
        
        // Reset form
        this.reset();
        
        // Refresh crop list
        setTimeout(() => {
            loadCropsForThuaDat(currentThuaDatId);
            
            // Show detail modal again
            const detailModal = new bootstrap.Modal(document.getElementById('thuaDatDetailModal'));
            detailModal.show();
        }, 300);
    });
</script>
