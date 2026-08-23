-- =========================================
-- HNMU NEWS - SEED DATA
-- =========================================

USE hnmu_news;


-- =========================================
-- THÊM DANH MỤC
-- =========================================

INSERT INTO DanhMuc (TenDanhMuc, MoTa)
VALUES
('Tin tức', 'Tin tức mới nhất của HNMU'),
('Giáo dục', 'Thông tin về giáo dục và đào tạo'),
('Sinh viên', 'Hoạt động của sinh viên HNMU'),
('Thông báo', 'Các thông báo từ nhà trường');


-- =========================================
-- THÊM TÁC GIẢ
-- =========================================

INSERT INTO TacGia (HoTen, Email, AnhDaiDien)
VALUES
('Nguyễn Văn An', 'an@hnmu.edu.vn', 'an.jpg'),
('Trần Thị Bình', 'binh@hnmu.edu.vn', 'binh.jpg'),
('Lê Minh Anh', 'anh@hnmu.edu.vn', 'anh.jpg');


-- =========================================
-- THÊM BÀI VIẾT
-- =========================================

INSERT INTO BaiViet
(
    TieuDe,
    TomTat,
    NoiDung,
    AnhDaiDien,
    NgayDang,
    TrangThai,
    MaDanhMuc,
    MaTacGia
)
VALUES
(
    'HNMU tổ chức lễ khai giảng năm học mới',
    'Lễ khai giảng năm học mới được tổ chức trang trọng.',
    'Trường Đại học Thủ đô Hà Nội tổ chức lễ khai giảng năm học mới với sự tham gia của giảng viên và sinh viên.',
    'khai-giang.jpg',
    '2026-08-20 08:00:00',
    'Đã đăng',
    1,
    1
),
(
    'Sinh viên HNMU tham gia hoạt động tình nguyện',
    'Sinh viên tích cực tham gia các hoạt động tình nguyện.',
    'Các sinh viên HNMU đã tham gia nhiều hoạt động tình nguyện và hỗ trợ cộng đồng.',
    'tinh-nguyen.jpg',
    '2026-08-21 09:30:00',
    'Đã đăng',
    3,
    2
),
(
    'Thông báo lịch học học kỳ mới',
    'Nhà trường thông báo lịch học dành cho sinh viên.',
    'Nhà trường công bố lịch học học kỳ mới để sinh viên chủ động sắp xếp thời gian.',
    'lich-hoc.jpg',
    '2026-08-22 10:00:00',
    'Đã đăng',
    4,
    3
),
(
    'HNMU triển khai chương trình đào tạo mới',
    'Chương trình đào tạo mới được triển khai trong năm học này.',
    'Nhà trường triển khai chương trình đào tạo mới nhằm nâng cao chất lượng giáo dục.',
    'dao-tao.jpg',
    '2026-08-23 08:30:00',
    'Đã đăng',
    2,
    1
);