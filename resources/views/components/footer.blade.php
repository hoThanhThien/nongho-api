<!-- Footer Component -->
<footer class="bg-light border-top mt-5 py-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="fas fa-leaf text-success me-2"></i>
                    <span class="text-muted small">
                        © {{ date('Y') }} Hệ thống Quản lý Nông hộ. 
                        Phát triển bởi <strong>Your Team</strong>
                    </span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-md-end align-items-center">
                    <span class="text-muted small me-3">Phiên bản 1.0.0</span>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary" title="Hỗ trợ">
                            <i class="fas fa-question-circle"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" title="Báo lỗi">
                            <i class="fas fa-bug"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" title="Phản hồi">
                            <i class="fas fa-comment"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-12">
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar bg-success" 
                         role="progressbar" 
                         style="width: 100%" 
                         aria-valuenow="100" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
