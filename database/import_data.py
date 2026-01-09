import pandas as pd
from sqlalchemy import create_engine
import os

# 1. Konfigurasi Koneksi ke database_retail
db_url = 'mysql+pymysql://root:@localhost/database_retail'
engine = create_engine(db_url)

# 2. Path File CSV
# Karena skrip ini di folder 'database', kita naik satu tingkat (..) lalu masuk ke folder 'data'
file_path = os.path.join('..', 'data', 'online_retail.csv')

print(f"Membuka file: {file_path}")
print("Sedang memproses impor data ke database_retail... Mohon tunggu.")

try:
    # 3. Proses Impor dengan Teknik Chunking (Memotong data jadi bagian kecil)
    # Ini mencegah error 'Memory Full' karena file terlalu besar
    chunk_size = 10000
    for i, chunk in enumerate(pd.read_csv(file_path, encoding='ISO-8859-1', chunksize=chunk_size)):
        # Nama tabel yang akan dibuat otomatis adalah 'online_retail'
        chunk.to_sql('online_retail', con=engine,
                     if_exists='append', index=False)
        print(f"Berhasil memasukkan {(i+1) * chunk_size} baris...")

    print("\n[SUKSES] Semua data telah berhasil dipindahkan ke MySQL!")

except Exception as e:
    print(f"\n[ERROR] Terjadi kendala: {e}")
