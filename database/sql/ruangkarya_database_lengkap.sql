-- RuangKarya - import database lengkap (phpMyAdmin)
-- Jalankan setelah memilih database yang dipakai Laravel (.env DB_DATABASE).
-- Password admin dan seluruh kreator: 12345678

START TRANSACTION;

SET FOREIGN_KEY_CHECKS = 0;

-- IMPORT ULANG: hapus data lama karya/galeri, lalu reset ID agar urut dari awal.
DELETE FROM interaksis;
DELETE FROM pendaftaran_events;
DELETE FROM karyas;
DELETE FROM events;
ALTER TABLE karyas AUTO_INCREMENT = 1;
ALTER TABLE interaksis AUTO_INCREMENT = 1;
ALTER TABLE events AUTO_INCREMENT = 1;

UPDATE users SET password = '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u';

INSERT INTO users (nama, email, password, role, username, status_akun, bio, foto_profil, created_at, updated_at)
VALUES
('Nadia Putri', 'admin@ruangkarya.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'admin', 'admin', 'aktif', 'Administrator RuangKarya.', NULL, NOW(), NOW()),
('Budi Santoso', 'budi@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'budi', 'aktif', 'Musisi dan pencipta lagu.', NULL, NOW(), NOW()),
('Rina Ayu', 'rina@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'rina', 'aktif', 'Seniman visual dan ilustrator.', NULL, NOW(), NOW()),
('Andi Wijaya', 'andi@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'andi', 'aktif', 'Penulis dan sineas.', NULL, NOW(), NOW()),
('Dewi Lestari', 'dewi@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'dewi', 'aktif', 'Perempuan kreatif lintas media.', NULL, NOW(), NOW()),
('Sari Melati', 'sari@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'sari', 'aktif', 'Kreator kriya dan musik.', NULL, NOW(), NOW()),
('Fajar Nugroho', 'fajar@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'fajar', 'aktif', 'Fotografer dan kreator digital.', NULL, NOW(), NOW()),
('Maya Kusuma', 'maya@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'maya', 'aktif', 'Perupa, penari, dan perajin.', NULL, NOW(), NOW()),
('Reza Pratama', 'reza@mail.com', '$2y$10$FbIcQ0cJi.fwaeNdbdSmrOtIXKFgwFK2j8aO2bUtxXFpYp8RYfM.u', 'kreator', 'reza', 'aktif', 'Kreator multimedia dan digital.', NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE nama=VALUES(nama), role=VALUES(role), username=VALUES(username), status_akun=VALUES(status_akun), bio=VALUES(bio), updated_at=NOW();

SET @admin := (SELECT id FROM users WHERE email='admin@ruangkarya.com');
SET @budi := (SELECT id FROM users WHERE email='budi@mail.com');
SET @rina := (SELECT id FROM users WHERE email='rina@mail.com');
SET @andi := (SELECT id FROM users WHERE email='andi@mail.com');
SET @dewi := (SELECT id FROM users WHERE email='dewi@mail.com');
SET @sari := (SELECT id FROM users WHERE email='sari@mail.com');
SET @fajar := (SELECT id FROM users WHERE email='fajar@mail.com');
SET @maya := (SELECT id FROM users WHERE email='maya@mail.com');
SET @reza := (SELECT id FROM users WHERE email='reza@mail.com');

-- Tambahan kolom yang dipakai tampilan, aman dijalankan meski sudah ada.
SET @sql := (SELECT IF(COUNT(*)=0,'ALTER TABLE karyas ADD COLUMN kategori VARCHAR(50) NULL AFTER lorong','SELECT 1') FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name='karyas' AND column_name='kategori');
PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;
SET @sql := (SELECT IF(COUNT(*)=0,'ALTER TABLE karyas ADD COLUMN model_url VARCHAR(255) NULL AFTER file_karya','SELECT 1') FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name='karyas' AND column_name='model_url');
PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;

INSERT INTO karyas (id_users,judul,deskripsi,lorong,kategori,file_karya,model_url,isi_teks,status,created_at,updated_at) VALUES
-- SUARA
(@budi,'Senja Sudut Kota','Single musikal nuansa senja kota.','suara','lagu','27JBYWc4xN7OY4NJQ68pni',NULL,NULL,'aktif',NOW(),NOW()),
(@rina,'Kota Ini Tak Sama Tanpamu','Lagu tentang kerinduan dan perjalanan kota.','suara','lagu','4uLU6hMCjMI75M1A2tKUQC',NULL,NULL,'aktif',NOW(),NOW()),
(@andi,'Melukis Senja (Acoustic)','Versi akustik tentang melukis senja.','suara','cover','6habFhsOp2NvshLv26DqMb',NULL,NULL,'aktif',NOW(),NOW()),
(@dewi,'Mata Ke Hati (Lo-Fi Remix)','Remix lo-fi yang hangat dan tenang.','suara','remix','59EPbYaZgU4qrQy1OwwhKt',NULL,NULL,'aktif',NOW(),NOW()),
(@sari,'Lofi Chill','Instrumental lo-fi untuk menemani waktu.','suara','instrumental','4cOdK2wGLETKBW3PvgPWqT',NULL,NULL,'aktif',NOW(),NOW()),
(@budi,'Midnight Cafe','Irama malam yang lembut.','suara','instrumental','3frQ4BqdEpexg26KsbLcSU',NULL,NULL,'aktif',NOW(),NOW()),
-- RUPA
(@rina,'Senja di Ujung Kertas','Lukisan suasana senja di atas kertas.','rupa','lukisan','images/rupa/10.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@maya,'Kucing Oren','Ilustrasi karakter kucing orange.','rupa','ilustrasi','images/rupa/12.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@dewi,'Hujan Pertama','Lukisan suasana hujan pertama.','rupa','lukisan','images/rupa/13.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Jalanan Kota','Fotografi jalanan kota.','rupa','fotografi','images/rupa/16.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@sari,'Bunga Kering','Ilustrasi bunga yang telah mengering.','rupa','ilustrasi','images/rupa/11.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@budi,'Langit Malam','Karya digital suasana langit malam.','rupa','digital','images/rupa/14.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@dewi,'Wajah Kakek','Ilustrasi potret wajah kakek.','rupa','ilustrasi','images/rupa/15.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
-- CAHAYA
(@andi,'Film Pendek 1','Karya film pendek.','cahaya','film','https://youtu.be/Vp8LGSej1c8',NULL,NULL,'aktif',NOW(),NOW()),
(@reza,'Film Pendek 2','Karya film pendek.','cahaya','film','https://youtu.be/SFK3bDVfXE0',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Animasi 1','Karya animasi pendek.','cahaya','animasi','https://youtu.be/ypfPpHi9tEc',NULL,NULL,'aktif',NOW(),NOW()),
(@reza,'Animasi 2','Karya animasi pendek.','cahaya','animasi','https://youtu.be/sghAqhta08E',NULL,NULL,'aktif',NOW(),NOW()),
(@budi,'Video Musik 1','Video musik.','cahaya','mv','https://youtu.be/zyLmavBAY7k',NULL,NULL,'aktif',NOW(),NOW()),
(@rina,'Video Musik 2','Video musik.','cahaya','mv','https://youtu.be/Wh66ThpxvI4',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Sinematik 1','Karya sinematik.','cahaya','broll','https://youtu.be/ChxDEAN8EtY',NULL,NULL,'aktif',NOW(),NOW()),
(@andi,'Sinematik 2','Karya sinematik.','cahaya','broll','https://youtu.be/mX0qUFos-Kc',NULL,NULL,'aktif',NOW(),NOW()),
(@maya,'Bioskop 1','Karya kategori bioskop.','cahaya','bioskop','https://youtu.be/yJxjOW9j7Og',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Bioskop 2','Karya kategori bioskop.','cahaya','bioskop','https://youtu.be/Sh6ryxsOHYg',NULL,NULL,'aktif',NOW(),NOW()),
(@andi,'Tutorial 1','Video tutorial produksi.','cahaya','tutorial','https://youtu.be/PuNMtXSRPZw',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Tutorial 2','Video tutorial produksi.','cahaya','tutorial','https://youtu.be/OJJqk0CRRLk',NULL,NULL,'aktif',NOW(),NOW()),
-- KATA
(@andi,'Rumah yang Hilang','Malam itu, rumah tua di ujung gang sudah tidak lagi seperti yang kuingat. Dari luar rumah itu berdiri, namun aku sadar rumah dapat hilang meski dindingnya tetap ada.','kata',NULL,NULL,NULL,'Malam itu, rumah tua di ujung gang sudah tidak lagi seperti yang kuingat. Cat pintunya mengelupas dan aku sadar rumah adalah tempat yang dapat hilang meski dindingnya tetap ada.','aktif',NOW(),NOW()),
(@rina,'Senja di Peron','Seorang perempuan menunggu kereta terakhir sambil memegang surat yang belum sempat dibaca. Senja perlahan membangunkan kata-kata yang selama ini ditahan.','kata','puisi',NULL,NULL,'Senja jatuh di peron\nKereta datang membawa sunyi\nNamamu tertinggal di setiap gerbong\nAku pulang dengan sisa cahaya','aktif',NOW(),NOW()),
(@dewi,'Catatan Hujan','Catatan harian tentang kehilangan, perubahan, dan harapan kecil yang tumbuh saat hujan berhenti.','kata','cerpen',NULL,NULL,'Hujan sore itu jatuh selama hampir dua jam. Saat reda, kota tampak berbeda, seolah semua luka diberi kesempatan untuk memulai lagi.','aktif',NOW(),NOW()),
-- PANGGUNG
(@maya,'Tarian 1','Pertunjukan tari.','panggung','tari','https://youtu.be/oqQeB9cIps4',NULL,NULL,'aktif',NOW(),NOW()),
(@maya,'Tarian 2','Pertunjukan tari.','panggung','tari','https://youtu.be/kSRhXOfWrIg',NULL,NULL,'aktif',NOW(),NOW()),
(@andi,'Teater 1','Pertunjukan teater.','panggung','teater','https://youtu.be/c8ADsQFhznc',NULL,NULL,'aktif',NOW(),NOW()),
(@reza,'Teater 2','Pertunjukan teater.','panggung','teater','https://youtu.be/om7PdiMycz0',NULL,NULL,'aktif',NOW(),NOW()),
(@budi,'Stand-Up 1','Pertunjukan stand-up comedy.','panggung','standup','https://youtu.be/hpnGa229X_k',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Stand-Up 2','Pertunjukan stand-up comedy.','panggung','standup','https://youtu.be/8DNQ8DYgCJE',NULL,NULL,'aktif',NOW(),NOW()),
(@budi,'Musik Live 1','Pertunjukan musik langsung.','panggung','musik','https://youtu.be/jFd1hhqX-0U',NULL,NULL,'aktif',NOW(),NOW()),
(@sari,'Musik Live 2','Pertunjukan musik langsung.','panggung','musik','https://youtu.be/cmICctnAWCY',NULL,NULL,'aktif',NOW(),NOW()),
(@maya,'Performance Art','Pertunjukan seni performa.','panggung','performance','https://youtu.be/ELNppge75AA',NULL,NULL,'aktif',NOW(),NOW()),
-- TANGAN + GLB
(@maya,'Vas keramik','Keramik buatan tangan.','tangan','keramik','images/tangan/1.jpeg','models/vas_lily.glb',NULL,'aktif',NOW(),NOW()),
(@dewi,'vas cute','Vas keramik bergaya playful.','tangan','keramik','images/tangan/2.jpeg','models/vas-squiggle.glb',NULL,'aktif',NOW(),NOW()),
(@maya,'mangkuk','Mangkuk keramik.','tangan','keramik','images/tangan/3.jpeg','models/mangkuk.glb',NULL,'aktif',NOW(),NOW()),
(@sari,'Keranjang','Keranjang hasil kriya tangan.','tangan','daur','images/tangan/4.jpeg','models/keranjang.glb',NULL,'aktif',NOW(),NOW()),
(@fajar,'Sikat cantik','Karya produk tangan.','tangan','produk','images/tangan/5.jpeg','models/sikat.glb',NULL,'aktif',NOW(),NOW()),
(@sari,'Tas anyaman','Tas dari rajutan dan anyaman.','tangan','tekstil','images/tangan/6.jpeg','models/tas.glb',NULL,'aktif',NOW(),NOW()),
(@maya,'Lampu','Lampu dekorasi buatan tangan.','tangan','produk','images/tangan/7.jpeg','models/lampu.glb',NULL,'aktif',NOW(),NOW()),
(@reza,'Ayunan','Ayunan kriya untuk ruang nyaman.','tangan','daur','images/tangan/8.jpeg','models/ayunan.glb',NULL,'aktif',NOW(),NOW()),
-- DIGITAL
(@reza,'Pixel Character','Karakter ilustrasi digital.','digital','ilustrasi','images/rupa/14.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@fajar,'Poster Jakarta','Poster desain kota digital.','digital','poster','images/rupa/16.jpeg',NULL,NULL,'aktif',NOW(),NOW()),
(@rina,'Komik Hujan','Komik digital bertema hujan.','digital','komik','images/rupa/13.jpeg',NULL,NULL,'aktif',NOW(),NOW());

-- KOMUNITAS: ditangani sebagai karya kata tanpa file agar cocok dengan controller.
INSERT INTO karyas (id_users,judul,deskripsi,lorong,kategori,file_karya,model_url,isi_teks,status,created_at,updated_at) VALUES
(@andi,'[Diskusi] Bagaimana ruang kreatif tumbuh?', 'Mari berbagi pengalaman membangun ruang kreatif bersama.', 'kata',NULL,NULL,NULL,'Mari berbagi pengalaman membangun ruang kreatif bersama.', 'aktif',NOW(),NOW()),
(@maya,'[Kolaborasi] Proyek musik ilustrasi', 'Saya membuka kolaborasi musik dan ilustrasi.', 'kata',NULL,NULL,NULL,'Saya membuka kolaborasi musik dan ilustrasi.', 'aktif',NOW(),NOW()),
(@fajar,'[Kritik] Mencari sudut fotografi baru', 'Bagaimana cara memberi makna lebih kuat pada foto jalanan?', 'kata',NULL,NULL,NULL,'Bagaimana cara memberi makna lebih kuat pada foto jalanan?', 'aktif',NOW(),NOW()),
(@dewi,'[Gagal] Belajar lagi setelah karya ditolak', 'Berbagi pengalaman bangkit dari penolakan karya.', 'kata',NULL,NULL,NULL,'Berbagi pengalaman bangkit dari penolakan karya.', 'aktif',NOW(),NOW());

-- Interaksi enum.
ALTER TABLE interaksis MODIFY jenis_interaksi ENUM('like','komentar','catatan_tempel','follow','simpan') NOT NULL;

DELETE FROM interaksis;
INSERT INTO interaksis (id_users,id_karya,jenis_interaksi,isi_interaksi,tipe_komentar,created_at,updated_at)
SELECT u.id,k.id,'like',NULL,NULL,NOW(),NOW()
FROM karyas k
JOIN users u ON u.role IN ('kreator','pengunjung')
WHERE k.status='aktif'
  AND u.id IN (@budi,@rina,@andi,@dewi,@sari);

INSERT INTO interaksis (id_users,id_karya,jenis_interaksi,isi_interaksi,tipe_komentar,created_at,updated_at)
SELECT u.id,k.id,'komentar',
       CASE MOD(k.id+u.id,4) WHEN 0 THEN 'Karyanya indah dan penyampaiannya kuat.' WHEN 1 THEN 'Konsepnya menarik dan detailnya sangat diperhatikan.' WHEN 2 THEN 'Suka suasana yang dibangun, semoga terus berkarya.' ELSE 'Boleh tahu proses membuat karya ini?' END,
       CASE MOD(k.id+u.id,3) WHEN 0 THEN 'pujian' WHEN 1 THEN 'kritik' ELSE 'tanya' END,
       NOW(),NOW()
FROM karyas k
JOIN users u ON u.id IN (@budi,@rina,@andi,@dewi,@sari)
WHERE k.status='aktif';

INSERT INTO interaksis (id_users,id_karya,jenis_interaksi,isi_interaksi,tipe_komentar,created_at,updated_at)
SELECT u.id,k.id,'catatan_tempel',
       CASE MOD(k.id+u.id,3) WHEN 0 THEN 'Bagian ini paling berkesan bagiku.' WHEN 1 THEN 'Suka sekali dengan rasa dan konsepnya.' ELSE 'Aku ingin mengingat karya ini.' END,
       NULL,NOW(),NOW()
FROM karyas k
JOIN users u ON u.id IN (@budi,@rina,@andi)
WHERE k.status='aktif';

-- Follow antar kreator.
INSERT INTO interaksis (id_users,id_target_users,jenis_interaksi,isi_interaksi,created_at,updated_at) VALUES
(@rina,@budi,'follow',NULL,NOW(),NOW()),(@andi,@budi,'follow',NULL,NOW(),NOW()),(@dewi,@rina,'follow',NULL,NOW(),NOW()),
(@sari,@rina,'follow',NULL,NOW(),NOW()),(@maya,@andi,'follow',NULL,NOW(),NOW()),(@fajar,@andi,'follow',NULL,NOW(),NOW()),
(@reza,@maya,'follow',NULL,NOW(),NOW()),(@budi,@dewi,'follow',NULL,NOW(),NOW()),(@andi,@maya,'follow',NULL,NOW(),NOW());

-- Event.
DELETE FROM events;
INSERT INTO events (id_users,judul_event,deskripsi,lokasi,tanggal_mulai,tanggal_selesai,tanggal_buka_daftar,tanggal_tutup_daftar,status,rundown,created_at,updated_at)
VALUES
(@admin,'Festival RuangKarya 2026','Festival lintas seni musisi, perupa, penulis, dan komunitas kreatif.','Gedung Kreatif Kota',DATE_ADD(NOW(),INTERVAL 14 DAY),DATE_ADD(NOW(),INTERVAL 15 DAY),NOW(),DATE_ADD(NOW(),INTERVAL 10 DAY),'aktif','[{"waktu":"09:00","judul":"Pembukaan"},{"waktu":"10:00","judul":"Pameran rupa"},{"waktu":"13:00","judul":"Musik dan pertunjukan"}]',NOW(),NOW()),
(@admin,'Workshop Fotografi Senja','Workshop fotografi cahaya senja bersama kreator lokal.','Studio Cahaya RuangKarya',DATE_ADD(NOW(),INTERVAL 21 DAY),DATE_ADD(NOW(),INTERVAL 21 DAY),NOW(),DATE_ADD(NOW(),INTERVAL 18 DAY),'aktif','[{"waktu":"09:00","judul":"Teori cahaya"},{"waktu":"11:00","judul":"Praktik fotografi"}]',NOW(),NOW()),
(@maya,'Pameran Kriya Tangan 3D','Pameran karya tangan beserta model 3D.','Galeri Lorong Tangan',DATE_ADD(NOW(),INTERVAL 30 DAY),DATE_ADD(NOW(),INTERVAL 32 DAY),NOW(),DATE_ADD(NOW(),INTERVAL 27 DAY),'aktif','[{"waktu":"10:00","judul":"Pembukaan pameran"},{"waktu":"13:00","judul":"Demo kriya"}]',NOW(),NOW());

-- Komentar event bila kolom id_event tersedia.
SET @has_event := (SELECT COUNT(*) FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name='interaksis' AND column_name='id_event');
SET @sql := IF(@has_event=0,'SELECT 1',CONCAT("INSERT INTO interaksis(id_users,id_event,jenis_interaksi,isi_interaksi,tipe_komentar,created_at,updated_at) SELECT u.id,e.id,'komentar','Saya tertarik mengikuti acara ini.','pujian',NOW(),NOW() FROM events e JOIN users u ON u.id IN (",@budi,',',@rina,',',@andi,")"));
PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

SELECT role, COUNT(*) AS jumlah FROM users GROUP BY role;
SELECT lorong, COUNT(*) AS jumlah_karya FROM karyas WHERE status='aktif' GROUP BY lorong;
SELECT jenis_interaksi, COUNT(*) AS jumlah FROM interaksis GROUP BY jenis_interaksi;
SELECT COUNT(*) AS jumlah_event FROM events;
