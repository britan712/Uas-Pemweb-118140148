
# Website Pemberian Nilai.


## Installation

Clone From Github.

```bash
  git clone <~Git URL~>
  cd uas_britan
  Open Project : http://localhost/uas_britan/index.php
```
    
## Notes

Jika Terjadi Kesalahan pada URL untuk menjalankan Aplikasi, maka setiap variable dengan nama <"apiUrl"> dapat dirubah dengan directory tujuan ke folder "server" dimana itu bertugas untuk menjalankan API.

contoh pada file `"assets/script.js"`, terdapat kode : 
`const apiUrl = "http://localhost/uas_britan/server/";`
maka nilai dari variable apiUrl diubah menjadi nama directory yang kamu simpan.

File-file yang terdapat pemanggilan url API : 

```bash
  1. assets/script.js
  2. pages/login.js
  3. pages/register.js
  4. pages/update.js
```

Perlu diperharikan juga untuk file `"server/db_connection.js"` dimana terdapat variable `$host, $username, $password, dan $dbname` yang harus diisi sesuai dengan nama database yang kamu buat, access login yang kamu gunakan untuk ke phpMyAdmin/MySQL, dan host server local yang kamu gunakan. 

`Jika kamu tidak melakukan setting tersebut, Aplikasi  tidak akan berjalan dengan semestinya.`

