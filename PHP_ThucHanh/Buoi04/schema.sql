-- =========================================
-- HNMU NEWS - SCHEMA
-- Buổi 4 - Bài cá nhân
-- =========================================

CREATE DATABASE IF NOT EXISTS hnmu_news
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE hnmu_news;


-- =========================================
-- BẢNG DANH MỤC
-- =========================================

CREATE TABLE DanhMuc (
    MaDanhMuc INT PRIMARY KEY AUTO_INCREMENT,
    TenDanhMuc VARCHAR(100) NOT NULL,
    MoTa VARCHAR(255)
);


-- =========================================
-- BẢNG TÁC GIẢ
-- =========================================

CREATE TABLE TacGia (
    MaTacGia INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    AnhDaiDien VARCHAR(255)
);


-- =========================================
-- BẢNG BÀI VIẾT
-- =========================================

CREATE TABLE BaiViet (
    MaBaiViet INT PRIMARY KEY AUTO_INCREMENT,
    TieuDe VARCHAR(255) NOT NULL,
    TomTat TEXT,
    NoiDung TEXT,
    AnhDaiDien VARCHAR(255),
    NgayDang DATETIME NOT NULL,
    TrangThai VARCHAR(30) NOT NULL,

    MaDanhMuc INT NOT NULL,
    MaTacGia INT NOT NULL,

    FOREIGN KEY (MaDanhMuc)
        REFERENCES DanhMuc(MaDanhMuc),

    FOREIGN KEY (MaTacGia)
        REFERENCES TacGia(MaTacGia)
);