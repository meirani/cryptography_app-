<?php

namespace App\Http\Controllers;

use App\Models\Kriptografi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriptografiController extends Controller
{
    // Fungsi untuk menampilkan halaman enkripsi
    public function showEncryptionForm()
    {
        return view('encryption');
    }

    // Fungsi untuk menampilkan halaman dekripsi
    public function showDecryptionForm()
    {
        return view('decryption');
    }

    // Fungsi untuk halaman enkripsi
    public function encrypt(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'plain_text' => 'required|string',
            'key' => 'required|string',
        ]);

        // Ambil inputan
        $plainText = $request->input('plain_text');
        $key = $request->input('key'); // Key seperti password

        // Enkripsi menggunakan Hill Cipher
        $cipherText = $this->hillCipherEncrypt($plainText);

        // Simpan ke database (key dan cipher text)
        $kriptografi = new Kriptografi();
        $kriptografi->cipher_text = $cipherText;
        $kriptografi->key = $key;
        $kriptografi->panjang_text = strlen($plainText); // Simpan panjang asli pesan
        $kriptografi->save();

        // Kembalikan hasil ke halaman dengan pesan sukses
        return view('encryption')->with('cipherText', $cipherText);
    }

    // Fungsi untuk halaman dekripsi
    public function decrypt(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'cipher_text' => 'required|string',
            'key' => 'required|string', // Key seperti password
        ]);

        // Ambil inputan
        $cipherText = $request->input('cipher_text');
        $key = $request->input('key'); // Key seperti password

        // Cek apakah cipher_text dan key ada di database
        $encryptedData = DB::table('keyencry') // Ubah ke nama tabel yang benar
            ->where('cipher_text', $cipherText)
            ->where('key', $key)
            ->first();

        if ($encryptedData) {
            // Dapatkan panjang asli plain text dari database
            $originalLength = $encryptedData->panjang_text;

            // Jika ditemukan, lakukan proses dekripsi
            $plainText = $this->hillCipherDecrypt($cipherText);

            // Potong hasil dekripsi berdasarkan panjang asli plain text
            $plainText = substr($plainText, 0, $originalLength);

            return view('decryption')->with('plainText', $plainText);
        } else {
            // Jika tidak ditemukan, berikan pesan error
            return redirect()->back()->withErrors(['message' => 'Key atau Cipher text tidak sesuai!']);
        }
    }

    // Fungsi untuk enkripsi Hill Cipher
    private function hillCipherEncrypt($plainText)
    {
        // Ubah plain text menjadi array angka
        $message = strtoupper($plainText); // Ubah ke huruf besar
        $messageNumbers = [];
        for ($i = 0; $i < strlen($message); $i++) {
            $messageNumbers[] = ord($message[$i]) - ord('A'); // A=0, B=1, ...
        }

        // Jika jumlah huruf ganjil, tambahkan padding (misal 'X')
        if (count($messageNumbers) % 2 != 0) {
            $messageNumbers[] = ord('X') - ord('A');
        }

        // Matriks key [2 3] [1 4]
        $keyMatrix = [
            [2, 3],
            [1, 4]
        ];

        // Proses enkripsi
        $cipherText = [];
        for ($i = 0; $i < count($messageNumbers); $i += 2) {
            $P1 = $messageNumbers[$i];
            $P2 = $messageNumbers[$i + 1];
            $C1 = ($keyMatrix[0][0] * $P1 + $keyMatrix[0][1] * $P2) % 26;
            $C2 = ($keyMatrix[1][0] * $P1 + $keyMatrix[1][1] * $P2) % 26;
            $cipherText[] = chr($C1 + ord('A')); // Konversi kembali ke huruf
            $cipherText[] = chr($C2 + ord('A')); // Konversi kembali ke huruf
        }

        return implode('', $cipherText); // Gabungkan array menjadi string
    }

    // Fungsi untuk dekripsi Hill Cipher
    private function hillCipherDecrypt($cipherText)
    {
        // Ubah cipher text menjadi array angka (huruf besar ke angka basis 0)
        $cipherText = strtoupper($cipherText); // Ubah ke huruf besar (pastikan input huruf besar)
        $cipherNumbers = [];
        for ($i = 0; $i < strlen($cipherText); $i++) {
            $cipherNumbers[] = ord($cipherText[$i]) - ord('A'); // A=0, B=1, ...
        }

        // Invers dari key matriks [2 3] [1 4] adalah [6 15] [5 16]
        $keyInverseMatrix = [
            [6, 15],
            [5, 16]
        ];

        // Proses dekripsi
        $plainText = [];
        for ($i = 0; $i < count($cipherNumbers); $i += 2) {
            $C1 = $cipherNumbers[$i];
            $C2 = $cipherNumbers[$i + 1];

            // Dekripsi menggunakan invers matriks
            $P1 = ($keyInverseMatrix[0][0] * $C1 + $keyInverseMatrix[0][1] * $C2) % 26;
            $P2 = ($keyInverseMatrix[1][0] * $C1 + $keyInverseMatrix[1][1] * $C2) % 26;

            // Pastikan hasil P1 dan P2 positif
            $P1 = ($P1 < 0) ? $P1 + 26 : $P1;
            $P2 = ($P2 < 0) ? $P2 + 26 : $P2;

            // Konversi kembali ke huruf kecil
            $plainText[] = chr($P1 + ord('a')); // Huruf kecil
            $plainText[] = chr($P2 + ord('a')); // Huruf kecil
        }

        return implode('', $plainText); // Gabungkan array menjadi string

        $result = substr($result, 0, $originalLength); // Potong pesan ke panjang aslinya
    }
}
