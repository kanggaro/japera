CREATE TABLE JenisTempat(
	ID INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(20) NOT NULL,

    CONSTRAINT PK_ID_tempat PRIMARY KEY (ID)
);

CREATE TABLE StatusPembasmian(
	ID INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(30) NOT NULL,

    CONSTRAINT PK_ID_status PRIMARY KEY (ID)
);

CREATE TABLE JenisSerangga(
	ID INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(30) NOT NULL,

    CONSTRAINT PK_ID_serangga PRIMARY KEY (ID)
);

CREATE TABLE Pelanggan(
    ID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(40) NOT NULL,
    alamat VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    no_telepon VARCHAR(12) NOT NULL,
    foto_KTP BINARY NOT NULL,

    CONSTRAINT PK_ID_pelanggan PRIMARY KEY (ID)
);

CREATE TABLE PegawaiAdmin(
    ID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(40) NOT NULL,

    CONSTRAINT PK_ID_admin PRIMARY KEY (ID)
);

CREATE TABLE KoordinatorPembasmi(
    ID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(40) NOT NULL,
    no_telepon VARCHAR(12) NOT NULL,
    spesialis_tim VARCHAR(40) NOT NULL,
    sedang_bekerja INT NOT NULL,

    CONSTRAINT PK_ID_koordinator PRIMARY KEY (ID)
);

CREATE TABLE TiketKeluhan(
	ID INT NOT NULL AUTO_INCREMENT,
    judul_pembasmian VARCHAR(30) NOT NULL,
    foto_sarang VARCHAR(200) NOT NULL,
    tanggal_dibuat TIMESTAMP NOT NULL,
    estimasi_selesai TIMESTAMP DEFAULT NOW(),
    nilai_ulasan INT,
    ulasan INT,
    bukti_bayar VARCHAR(200),
    tempat_ID INT NOT NULL,
    status_ID INT NOT NULL,
    koordinator_ID INT NOT NULL,
    serangga_ID INT NOT NULL,
    pelanggan_ID INT NOT NULL,
    admin_ID INT NOT NULL,
    
    CONSTRAINT PK_ID_tiket PRIMARY KEY (ID),
    CONSTRAINT TK_tempat_ID_FK FOREIGN KEY (tempat_ID) REFERENCES JenisTempat(ID),
    CONSTRAINT TK_status_ID_FK FOREIGN KEY (status_ID) REFERENCES StatusPembasmian(ID),
    CONSTRAINT TK_koordinator_ID_FK FOREIGN KEY (koordinator_ID) REFERENCES KoordinatorPembasmi(ID),
    CONSTRAINT TK_serangga_ID_FK FOREIGN KEY (serangga_ID) REFERENCES JenisSerangga(ID),
    CONSTRAINT TK_pelanggan_ID_FK FOREIGN KEY (pelanggan_ID) REFERENCES Pelanggan(ID),
	CONSTRAINT TK_admin_ID_FK FOREIGN KEY (admin_ID) REFERENCES PegawaiAdmin(ID)
);

CREATE TABLE BiayaLayanan(
    ID INT NOT NULL AUTO_INCREMENT,
    tiket_ID INT NOT NULL,
    nama VARCHAR(30) NOT NULL,
    jumlah INT NOT NULL,
    total_harga INT NOT NULL,

    CONSTRAINT BL_tiket_ID_FK FOREIGN KEY (tiket_ID) REFERENCES TiketKeluhan(ID),
    CONSTRAINT PK_ID_biaya_layanan PRIMARY KEY (ID)
);

CREATE TABLE Logistik(
    ID INT NOT NULL AUTO_INCREMENT,
    nama_barang VARCHAR(30) NOT NULL,
    jumlah INT NOT NULL,
    total_harga INT NOT NULL,
    admin_ID INT NOT NULL,

    CONSTRAINT PK_ID_logistik PRIMARY KEY (ID),
    CONSTRAINT LG_admin_ID_FK FOREIGN KEY (admin_ID) REFERENCES PegawaiAdmin(ID)
);

