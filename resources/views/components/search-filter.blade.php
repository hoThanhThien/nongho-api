<!-- Search Component -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="{{ $placeholder ?? 'Tìm kiếm...' }}">
        </div>
    </div>
    <div class="col-md-6 text-end">
        @if(isset($showFilters) && $showFilters)
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-filter me-2"></i>Bộ lọc
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-filter="all">Tất cả</a></li>
                <li><a class="dropdown-item" href="#" data-filter="active">Đang hoạt động</a></li>
                <li><a class="dropdown-item" href="#" data-filter="inactive">Không hoạt động</a></li>
            </ul>
        </div>
        @endif
        
        @if(isset($exportButton) && $exportButton)
        <button type="button" class="btn btn-outline-success ms-2" onclick="exportToExcel()">
            <i class="fas fa-file-excel me-2"></i>Xuất Excel
        </button>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('tbody tr');
        
        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const shouldShow = text.includes(searchTerm);
                row.style.display = shouldShow ? '' : 'none';
            });
            
            // Update row count
            const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
            updateRowNumbers(visibleRows);
        });
        
        // Filter functionality
        document.querySelectorAll('[data-filter]').forEach(filterBtn => {
            filterBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const filterValue = this.getAttribute('data-filter');
                
                tableRows.forEach(row => {
                    if (filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        const status = row.querySelector('.badge')?.textContent.toLowerCase();
                        const shouldShow = status?.includes(filterValue === 'active' ? 'hoạt động' : 'không hoạt động');
                        row.style.display = shouldShow ? '' : 'none';
                    }
                });
                
                const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
                updateRowNumbers(visibleRows);
            });
        });
    });
    
    function updateRowNumbers(rows) {
        rows.forEach((row, index) => {
            const numberCell = row.querySelector('td:first-child');
            if (numberCell && !isNaN(numberCell.textContent)) {
                numberCell.textContent = index + 1;
            }
        });
    }
    
    function exportToExcel() {
        // Simple export functionality
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
        
        let csvContent = '';
        rows.forEach(row => {
            const cells = Array.from(row.cells).map(cell => '"' + cell.textContent.trim() + '"');
            csvContent += cells.join(',') + '\n';
        });
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', 'export.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
