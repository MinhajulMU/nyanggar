link aplikasi:
http://nyanggar.ukmriptek.org


Aplikasi Nyanggar.id ini merupakan platform yang menjembatani antara penari lokal dengan masyarakat. Sehingga para penari lokal dapat menawarkan jasanya melalui portal ini begitupun sebaliknya, masyarakat dapat mencari jasa penari melalui portal ini. Banyak aplikasi pencari jasa diluar sana namun setau saya belum ada platform khusus yang menyediakan untuk para penari lokal. Dan dengan adanya platform ini masyarakat bisa lebih mengenal tari-tarian khususnya tari tradisional di daerah mereka.

terdapat 2 user dalam aplikasi ini:

1. admin

login page: localhost/nyanggar/index.php/s3cr3t


username: admin
password: admin

tugas user admin adalah memanajemen aplikasi nyanggar.id termasuk didalamnya adalah memverifikasi pembayaran jasa les tari dan pesan pertunjukan secara manual.

2. user

terdapat 2 user yaitu client dan penari:


a. client
adalah user yang memiliki kewenangan memesan jasa dalam aplikasi nyanggar.id, yaitu pesan jasa les menari dan pesan jada pertunjukan

b. penari:
adalah user yang memiliki kewenangan menawarkan jasa dalam aplikasi nyanggar.id, yaitu menawarkan jasa les menari dan pesan jada pertunjukan.

alur aplikasi:

1. user mencari jasa
2. user memesan jasa
3. user membayar
4. admin memverifikasi pembayaran
5. penari melihat pesanan
6. penari bisa menerima/menolak pesanan
7. penari melaksanakan pesanan
8. user mengakhiri pesanan
9. uang ditranfer ke penari
10. selesai.

petunjuk instalasi aplikasi nyanggar.id

1. copy folder nyanggar ke web server anda
2. import database nyanggar.sql ke web server anda
3. perhatian untuk aplikasi ini ada fitur yang memerlukan upload < 20 MB.
maka dari itu diharapkan setting php.ini pada webserver harus dirubah sehingga
max_upload_file_size > 20000, max_post > 20000
4. kalau misal ribet mau merubah file php.ini sudah saya sediakan file saya 
yang sudah saya setting dan tinggal copy paste

5. terimakasih
6. apabila ada kesulitan atau error saat instalasi mohon maaf
bisa hubungi saya di 085726772962
