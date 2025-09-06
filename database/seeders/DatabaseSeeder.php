<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Tạo dữ liệu mẫu cho nông hộ
        DB::table('nong_hos')->insert([
            [
                'ten' => 'Nguyễn Văn An',
                'dia_chi' => 'Ấp Tân Hòa, Xã Tân Phước, Huyện Châu Thành, Tỉnh An Giang',
                'email' => 'nguyen.van.an@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten' => 'Trần Thị Bình',
                'dia_chi' => 'Ấp Long An, Xã Phú Hòa, Huyện Phú Tân, Tỉnh An Giang',
                'email' => 'tran.thi.binh@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten' => 'Lê Văn Cường',
                'dia_chi' => 'Ấp Hòa Bình, Xã Vĩnh Thạnh, Huyện Tịnh Biên, Tỉnh An Giang',
                'email' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Tạo dữ liệu mẫu cho thửa đất
        DB::table('thuadats')->insert([
            [
                'ten_thua' => 'Thửa đất số 1',
                'dien_tich' => 1000.50,
                'nongho_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_thua' => 'Thửa đất số 2',
                'dien_tich' => 850.25,
                'nongho_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_thua' => 'Thửa ruộng A',
                'dien_tich' => 1200.75,
                'nongho_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_thua' => 'Thửa vườn B',
                'dien_tich' => 750.00,
                'nongho_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Tạo dữ liệu mẫu cho cây trồng
        DB::table('cay_trongs')->insert([
            [
                'ten_cay' => 'Lúa OM5451',
                'loai_cay' => 'lúa',
                'giong' => 'OM5451',
                'dien_tich' => 500.25,
                'thua_dat_id' => 1,
                'ngay_trong' => '2025-06-01',
                'trang_thai' => 'đang_phát_triển',
                'ghi_chu' => 'Giống lúa chất lượng cao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_cay' => 'Lúa IR64',
                'loai_cay' => 'lúa',
                'giong' => 'IR64',
                'dien_tich' => 500.25,
                'thua_dat_id' => 1,
                'ngay_trong' => '2025-06-01',
                'trang_thai' => 'đang_phát_triển',
                'ghi_chu' => 'Giống lúa thơm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_cay' => 'Ngô LVN10',
                'loai_cay' => 'ngô',
                'giong' => 'LVN10',
                'dien_tich' => 850.25,
                'thua_dat_id' => 2,
                'ngay_trong' => '2025-05-15',
                'trang_thai' => 'thu_hoạch',
                'ghi_chu' => 'Ngô ngọt năng suất cao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_cay' => 'Lúa Jasmine 85',
                'loai_cay' => 'lúa',
                'giong' => 'Jasmine 85',
                'dien_tich' => 600.00,
                'thua_dat_id' => 3,
                'ngay_trong' => '2025-07-01',
                'trang_thai' => 'đang_phát_triển',
                'ghi_chu' => 'Lúa thơm Jasmine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_cay' => 'Cam Canh',
                'loai_cay' => 'khác',
                'giong' => 'Cam Canh',
                'dien_tich' => 375.00,
                'thua_dat_id' => 4,
                'ngay_trong' => '2024-12-01',
                'trang_thai' => 'hoàn_thành',
                'ghi_chu' => 'Cam ngọt địa phương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_cay' => 'Xoài Cát Chu',
                'loai_cay' => 'khác',
                'giong' => 'Cát Chu',
                'dien_tich' => 375.00,
                'thua_dat_id' => 4,
                'ngay_trong' => '2024-11-15',
                'trang_thai' => 'hoàn_thành',
                'ghi_chu' => 'Xoài đặc sản miền Tây',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
