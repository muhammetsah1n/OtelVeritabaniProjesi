# Proje
- Otel Veritabanı Projesi

## Ekip Arkadaşları
- [Yağmur Kalyoncu](https://github.com/Yagmurkalyoncu)
- [Şahnur Çöğür](https://github.com/sahnurcgr)

## Genel Açıklama
- Bu proje, bir otel için oda kategorilerine göre rezervasyon işlemleri ve seçilen metota göre ödeme işlemleri gibi süreçleri kapsayan bir veritabanı sistemi geliştirmeyi amaçlamaktadır. Sistemde müşteri bilgileri, otelde bulunan oda kategorileri, odalar, otelin çalışanları , çalışanların bilgileri, ve müşterinin rezervasyon kaydı tutulmaktadır.

## Özellikler
- Fotoğraflar dosya yolları üzerinden kaydedilir.

- CUSTOMER ile RESERVATION arasında 1:N (Bir müşteri birden fazla rezervasyon yapabilir) ilişkisi vardır.
- RESERVATION ile PAYMENT arasında 1:1 (Her rezervasyonun tek bir ödemesi vardır) ilişkisi vardır.
- CUSTOMER ile PAYMENT arasında 1:N (Bir müşteri birden fazla ödeme yapabilir) ilişkisi vardır. 
- RESERVATION ile ROOMS arasında 1:1 (Bir rezervasyon bir odayı kapsayabilir) ilişkisi vardır.
- ROOMS ile ROOMS_CATEGORY arasında N:1 (Her oda yalnızca bir kategoriye aittir) ilişkisi vardır.
- ROOMS ile HOTEL arasında N:1 (Her oda yalnızca bir otele aittir) ilişkisi vardır.
- EMPLOYEE ile DEPARTMENT arasında N:1 (Her çalışan bir departmanda çalışır) ilişkisi vardır.
- EMPLOYEE ile HOTEL arasında N:1 (Her çalışan bir otelde çalışır) ilişkisi vardır

  



## Çıkarılan Dersler

- Bu projeyi inşaa ederken ekip olarak çalışmayı, görev dağılımı yapmayı ve proje hakkında tartışabilmeyi öğrendik.
- Ayrıca başlıca veritabanı yönetimi, ER diyagramı oluşturma gibi konularda kendi çapımızda tecrübe edindik.
  
