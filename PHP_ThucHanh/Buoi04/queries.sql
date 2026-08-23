-- =========================================
-- CÂU 1: Lấy danh sách bài viết hiển thị
-- trên trang chủ
-- =========================================

SELECT
    bv.MaBaiViet,
    bv.TieuDe,
    bv.TomTat,
    bv.AnhDaiDien,
    bv.NgayDang,
    dm.TenDanhMuc,
    tg.HoTen AS TacGia
FROM BaiViet bv
JOIN DanhMuc dm
    ON bv.MaDanhMuc = dm.MaDanhMuc
JOIN TacGia tg
    ON bv.MaTacGia = tg.MaTacGia
WHERE bv.TrangThai = 'Đã đăng'
ORDER BY bv.NgayDang DESC;

-- =========================================
-- CÂU 2: Lọc bài viết thuộc danh mục Giáo dục
-- =========================================

SELECT
    bv.MaBaiViet,
    bv.TieuDe,
    bv.TomTat,
    dm.TenDanhMuc,
    bv.NgayDang
FROM BaiViet bv
JOIN DanhMuc dm
    ON bv.MaDanhMuc = dm.MaDanhMuc
WHERE dm.TenDanhMuc = 'Giáo dục'
  AND bv.TrangThai = 'Đã đăng'
ORDER BY bv.NgayDang DESC;

-- =========================================
-- CÂU 3: Lấy bài viết của tác giả
-- Nguyễn Văn An
-- =========================================

SELECT
    bv.MaBaiViet,
    bv.TieuDe,
    bv.NgayDang,
    tg.HoTen AS TacGia
FROM BaiViet bv
JOIN TacGia tg
    ON bv.MaTacGia = tg.MaTacGia
WHERE tg.HoTen = 'Nguyễn Văn An'
  AND bv.TrangThai = 'Đã đăng'
ORDER BY bv.NgayDang DESC;