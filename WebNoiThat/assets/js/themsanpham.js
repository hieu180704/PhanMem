document.getElementById('tendanhmuc').addEventListener('change', function() {
    var tendanhmucID = this.value;
    var tendanhmuccon = document.getElementById('tendanhmuccon');
    
    // Xóa các option cũ
    tendanhmuccon.innerHTML = '<option value="">Không danh mục con</option>';
    
    // Thêm các option mới
    danhmuccon.forEach(function(dmc) {
        if (dmc.tendanhmuc == tendanhmucID) {
            var option = document.createElement('option');
            option.value = dmc.tendanhmuccon;
            option.text = dmc.tendanhmuccon;
            tendanhmuccon.add(option);
        }
    });
});