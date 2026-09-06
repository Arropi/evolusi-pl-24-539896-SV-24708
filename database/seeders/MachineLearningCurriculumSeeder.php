<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\Track;
use Illuminate\Database\Seeder;

class MachineLearningCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Track 1: Foundations of Machine Learning
        $track1 = Track::updateOrCreate(
            ['slug' => 'foundations-of-machine-learning'],
            [
                'title' => 'Foundations of Machine Learning',
                'description' => 'Kuasai fondasi matematika komputasi, struktur array n-dimensi, aljabar linier, dan manipulasi data berkinerja tinggi untuk AI.',
                'level' => 'Beginner',
                'order' => 1,
            ]
        );

        // Track 2: Supervised Learning & Regression
        $track2 = Track::updateOrCreate(
            ['slug' => 'supervised-learning-algorithms'],
            [
                'title' => 'Supervised Learning & Model Training',
                'description' => 'Pelajari algoritma Regresi Linier, Logistic Classification, Decision Trees, dan evaluasi metrik performa model.',
                'level' => 'Intermediate',
                'order' => 2,
            ]
        );

        // Track 3: Deep Neural Networks & Backpropagation
        $track3 = Track::updateOrCreate(
            ['slug' => 'deep-learning-neural-networks'],
            [
                'title' => 'Deep Neural Networks & Architectures',
                'description' => 'Pahami cara kerja arsitektur Artificial Neural Network (ANN), fungsi aktivasi, gradient descent, dan optimasi loss.',
                'level' => 'Advanced',
                'order' => 3,
            ]
        );

        // 2. Create Lessons for Track 1
        // Lesson 1: Full In-depth Content
        Lesson::updateOrCreate(
            ['slug' => 'fondasi-data-numpy-vektorisasi'],
            [
                'track_id' => $track1->id,
                'title' => 'Fondasi Data: Mengenal NumPy & Vektorisasi untuk Machine Learning',
                'order' => 1,
                'xp_reward' => 100,
                'estimated_minutes' => 12,
                'summary' => 'Pelajari mengapa NumPy menjadi fondasi utama seluruh ekosistem AI dan Data Science, cara kerja struktur array n-dimensi di memori, serta kekuatan komputasi vektorisasi tanpa perulangan manual.',
                'analogy_title' => 'Logika Dunia Nyata: Kantong Belanja Acak vs Kotak Bento Bersekat Presisi',
                'analogy_content' => '### 1. Analogi Memori: Kantong Plastik vs Kotak Bento Industri

Mari bayangkan bagaimana komputer menyimpan data di dalam memori RAM:

- **List Standar Python = Kantong Belanja Plastik Acak**
  List bawaan Python sangat fleksibel. Anda dapat memasukkan apel (string), botol saus (integer), baju (objek), dan kuitansi (boolean) ke dalam satu kantong. Namun, karena ukurannya berbeda-beda, Python terpaksa menyimpannya secara acak di berbagai sudut memori (*non-contiguous memory*). Ketika Anda ingin menghitung total kalori semua belanjaan, prosesor harus mencari satu per satu alamat memori dan memeriksa label tiap barang (*dynamic type checking*). Proses ini sangat lambat untuk data berjumlah jutaan.

- **NumPy Array (`ndarray`) = Kotak Bento Bersekat Seragam**
  NumPy array menuntut semua elemen memiliki tipe data yang persis sama (misalnya semuanya bilangan desimal `float32`). Data ini ditata rapi dalam satu blok memori berurutan (*contiguous memory buffer*). Ketika CPU atau GPU ingin membaca datanya, prosesor dapat langsung menyedot ribuan angka sekaligus dalam satu tarikan *cache line* (*cache locality*), menghasilkan kecepatan hingga ratusan kali lebih gesit.

---

### 2. Analogi Komputasi: Tukang Ketok Palu Manual vs Mesin Press Hidrolik Pabrik (Vektorisasi SIMD)

Bayangkan Anda bekerja di pabrik dan harus meratakan **1.000.000 kaleng minuman**:

- **Perulangan Tradisional (`for loop`)**:
  Ibarat seorang pekerja yang memegang satu palu kecil, lalu mengetuk kaleng satu demi satu secara berurutan. Setiap kaleng membutuhkan waktu dan tenaga terpisah. Di Python, `for loop` mengeksekusi iterasi dengan overhead interpretasi kode pada setiap langkah.

- **Vektorisasi NumPy (SIMD - Single Instruction, Multiple Data)**:
  Ibarat meletakkan ribuan kaleng sekaligus di atas sabuk konveyor raksasa, lalu menurunkan mesin press hidrolik berkekuatan tinggi. Dalam **satu kali hentakan instruksi**, seluruh baris kaleng pipih serempak. Inilah yang dilakukan prosesor modern melalui instruksi vektor SIMD (AVX/Neon) saat menjalankan operasi matematika NumPy.',
                'library_name' => 'NumPy (Numerical Python)',
                'library_why' => 'NumPy adalah pustaka komputasi numerik paling fundamental dalam ekosistem Python yang menjadi pondasi bagi pustaka tingkat atas seperti Scikit-Learn, PyTorch, TensorFlow, Pandas, dan OpenCV. 

Ditulis menggunakan bahasa **C dan Fortran** tingkat rendah yang terhubung langsung dengan pustaka aljabar linier performa tinggi (BLAS & LAPACK), NumPy memungkinkan manipulasi matriks berdimensi tinggi dengan efisiensi memori maksimal dan kecepatan komputasi mendekati kode native C.',
                'library_concepts' => [
                    [
                        'name' => 'Skalar (0D Tensor)',
                        'symbol' => 'x ∈ ℝ',
                        'desc' => 'Satu nilai numerik tunggal tanpa dimensi atau indeks. Dalam model Machine Learning, skalar sering merepresentasikan nilai konstan bias (b) atau skor loss (rugi).',
                        'example' => 'bias = np.float32(0.75)',
                    ],
                    [
                        'name' => 'Vektor Fitur (1D Tensor)',
                        'symbol' => 'x ∈ ℝⁿ',
                        'desc' => 'Larik 1 dimensi data karakteristik numerik suatu sampel pengamatan, misalnya vektor fitur rumah [luas, jumlah_kamar, usia_gedung].',
                        'example' => 'fitur = np.array([120.0, 3.0, 5.0])',
                    ],
                    [
                        'name' => 'Matriks Dataset (2D Tensor)',
                        'symbol' => 'X ∈ ℝ^(m × n)',
                        'desc' => 'Tabel dua dimensi yang memuat m baris (jumlah sampel data) dan n kolom (jumlah fitur pengamatan), menjadi input standar pelatihan model AI.',
                        'example' => 'dataset = np.array([[120, 3], [85, 2], [200, 4]])',
                    ],
                    [
                        'name' => 'Tensor Multidimensi (3D & 4D Tensor)',
                        'symbol' => 'T ∈ ℝ^(B × H × W × C)',
                        'desc' => 'Representasi data kompleks berdimensi tinggi, seperti batch citra visual komputer (Batch Size × Tinggi × Lebar × Channel Warna RGB).',
                        'example' => 'batch_gambar = np.zeros((32, 224, 224, 3))',
                    ],
                ],
                'code_example' => "# ==========================================================
# KOMPARASI: Looping Python Manual vs Vektorisasi NumPy
# Operasi: Komputasi Forward Pass Neuron Linier (y = W · x + b)
# ==========================================================
import numpy as np
import time

# 1. Inisialisasi Vektor Bobot (W), Fitur Input (x), dan Bias (b)
weights = np.array([0.45, 0.85, -0.30, 0.12], dtype=np.float32)
features = np.array([120.0, 3.5, 12.0, 1.0], dtype=np.float32)
bias = 0.50

# 2. CARA LAMBAT (Loop Tradisional Python)
start_slow = time.perf_counter()
output_slow = 0.0
for i in range(len(weights)):
    output_slow += weights[i] * features[i]
output_slow += bias
time_slow = time.perf_counter() - start_slow

# 3. CARA CEPAT & MODERN (Vektorisasi NumPy - Dot Product)
start_fast = time.perf_counter()
output_fast = np.dot(weights, features) + bias
time_fast = time.perf_counter() - start_fast

print(f'Hasil Prediksi Linier : {output_fast:.4f}')
print(f'Dimensi Array W       : {weights.shape} | Tipe Data: {weights.dtype}')
print(f'Vektorisasi selesai tanpa menuliskan perulangan for!')",
                'challenge_question' => 'Dalam arsitektur model Machine Learning, jika Anda memiliki matriks bobot W dan matriks fitur X, mengapa perkalian aljabar linier dengan vektorisasi `np.dot(W, X)` jauh lebih direkomendasikan dibanding menghitungnya menggunakan perulangan `for i in range(...)` di Python?',
                'challenge_options' => [
                    'Karena vektorisasi NumPy memanfaatkan instruksi perangkat keras SIMD dan memori C berurutan yang berjalan puluhan hingga ratusan kali lebih cepat tanpa overhead interpretasi baris per baris Python.',
                    'Karena loop for di Python hanya dapat memproses data teks string dan tidak dapat melakukan perkalian angka desimal secara matematis.',
                    'Karena fungsi np.dot secara otomatis menghapus nilai bias dan mereduksi matriks menjadi nilai kosong sehingga memori tidak terbebani.',
                    'Karena perulangan for di Python selalu membagi nilai matriks dengan nol yang mengakibatkan error pembagian pada sistem.',
                ],
                'challenge_correct_index' => 0,
                'challenge_explanation' => 'Tepat sekali! Vektorisasi NumPy mengeksekusi operasi matematika langsung pada lapisan pustaka C tingkat rendah yang mengoptimalkan instruksi SIMD (Single Instruction, Multiple Data) pada CPU/GPU, memproses banyak elemen data dalam satu siklus instruksi tanpa beban dinamis interpreter Python.',
            ]
        );

        // Lesson 2 (Locked Roadmap Node)
        Lesson::updateOrCreate(
            ['slug' => 'manipulasi-matriks-reshaping-broadcasting'],
            [
                'track_id' => $track1->id,
                'title' => 'Manipulasi Matriks & Tensor: Reshaping, Slicing, dan Broadcasting',
                'order' => 2,
                'xp_reward' => 100,
                'estimated_minutes' => 15,
                'summary' => 'Pahami mekanisme pengubahan bentuk matriks (reshape), pemilihan subset data (slicing), serta aturan otomatis perataan dimensi array (broadcasting) dalam pengolahan batch.',
                'analogy_title' => 'Logika Dunia Nyata: Cetakan Lilin & Aturan Penyesuaian Ukuran Otomatis',
                'analogy_content' => 'Materi lanjutan mengenai manipulasi dimensi tensor untuk persiapan data training model.',
                'library_name' => 'NumPy Advanced Matrix Operations',
                'library_why' => 'Diperlukan untuk menyesuaikan bentuk dimensi data masukan agar sesuai dengan matriks bobot layer AI.',
                'library_concepts' => [
                    ['name' => 'Array Reshaping', 'desc' => 'Mengubah susunan baris dan kolom tanpa mengubah data asli'],
                    ['name' => 'Broadcasting Rule', 'desc' => 'Menyelaraskan dimensi array berbeda ukuran secara otomatis'],
                ],
                'code_example' => "import numpy as np\nX = np.arange(12).reshape(3, 4)\nprint(X)",
                'challenge_question' => 'Apa syarat utama agar dua array dengan bentuk berbeda dapat dilakukan operasi broadcasting di NumPy?',
                'challenge_options' => [
                    'Dimensi yang bersesuaian harus bernilai sama atau salah satu dimensinya bernilai 1.',
                    'Kedua array harus memiliki jumlah elemen total yang ganjil.',
                    'Kedua array harus bertipe data string integer 64-bit.',
                    'Semua nilai di dalam array harus bernilai positif di atas nol.',
                ],
                'challenge_correct_index' => 0,
                'challenge_explanation' => 'Aturan broadcasting NumPy menyatakan bahwa dua dimensi kompatibel jika nilainya sama atau salah satunya bernilai 1.',
            ]
        );

        // Lesson 3 (Locked Roadmap Node)
        Lesson::updateOrCreate(
            ['slug' => 'aljabar-linier-dot-product-invers'],
            [
                'track_id' => $track1->id,
                'title' => 'Operasi Aljabar Linier: Dot Product, Matriks Transpose, dan Determinan',
                'order' => 3,
                'xp_reward' => 120,
                'estimated_minutes' => 15,
                'summary' => 'Mendalami operasi perkalian matriks, transpose, trace, invers, dan determinan yang menjadi jantung perhitungan optimasi gradien.',
                'analogy_title' => 'Logika Dunia Nyata: Sistem Transformasi Koordinat Ruang',
                'analogy_content' => 'Materi aljabar linier komputasi untuk machine learning.',
                'library_name' => 'NumPy Linear Algebra (linalg)',
                'library_why' => 'Digunakan dalam perhitungan persamaan normal regresi dan dekomposisi nilai singular (SVD).',
                'library_concepts' => [
                    ['name' => 'Matrix Transposition (X.T)', 'desc' => 'Membalik sumbu baris menjadi kolom'],
                    ['name' => 'Matrix Inversion (np.linalg.inv)', 'desc' => 'Menghitung invers matriks untuk solusi analitik'],
                ],
                'code_example' => "import numpy as np\nA = np.array([[1, 2], [3, 4]])\nA_inv = np.linalg.inv(A)\nprint(A_inv)",
                'challenge_question' => 'Kapan sebuah matriks persegi tidak memiliki invers (matriks singular)?',
                'challenge_options' => [
                    'Ketika nilai determinan dari matriks tersebut sama dengan 0.',
                    'Ketika ukuran matriks lebih besar dari 2x2.',
                    'Ketika seluruh nilai di dalam matriks bernilai pecahan desimal.',
                    'Ketika matriks tersebut dibuat menggunakan pustaka NumPy.',
                ],
                'challenge_correct_index' => 0,
                'challenge_explanation' => 'Matriks singular yang determinannya bernilai 0 tidak memiliki invers matematis.',
            ]
        );

        // Lesson 4 (Locked Roadmap Node)
        Lesson::updateOrCreate(
            ['slug' => 'statistik-deskriptif-normalisasi-data'],
            [
                'track_id' => $track1->id,
                'title' => 'Statistik Deskriptif & Teknik Normalisasi Data (Z-Score & MinMax)',
                'order' => 4,
                'xp_reward' => 120,
                'estimated_minutes' => 18,
                'summary' => 'Pelajari cara menghitung mean, variansi, standar deviasi, dan menerapkan penskalaan fitur (feature scaling) agar proses konvergensi gradient descent stabil.',
                'analogy_title' => 'Logika Dunia Nyata: Menstandarkan Satuan Ukuran Rupiah dan Meter',
                'analogy_content' => 'Materi penskalaan fitur dan normalisasi data.',
                'library_name' => 'NumPy Statistics & Scikit-Learn Preprocessing',
                'library_why' => 'Mencegah fitur bernilai skala besar mendominasi pembaruan bobot dalam model AI.',
                'library_concepts' => [
                    ['name' => 'Min-Max Scaling', 'desc' => 'Mentransformasi nilai fitur ke dalam rentang [0, 1]'],
                    ['name' => 'Standardization (Z-Score)', 'desc' => 'Memusatkan data dengan mean 0 dan deviasi standar 1'],
                ],
                'code_example' => "import numpy as np\ndata = np.array([10.0, 20.0, 30.0, 40.0, 50.0])\nz_score = (data - np.mean(data)) / np.std(data)\nprint(z_score)",
                'challenge_question' => 'Mengapa normalisasi fitur sangat krusial sebelum melatih model berbasis gradient descent seperti Neural Networks?',
                'challenge_options' => [
                    'Agar kontur fungsi loss menjadi lebih simetris sehingga gradient descent dapat bergerak lurus menuju global minimum tanpa osilasi berlebih.',
                    'Agar seluruh data yang bernilai negatif otomatis terhapus dari dataset latihan.',
                    'Agar ukuran file dataset di disk komputer bertambah dua kali lipat.',
                    'Agar model tidak perlu lagi menggunakan fungsi aktivasi non-linier.',
                ],
                'challenge_correct_index' => 0,
                'challenge_explanation' => 'Fitur dengan skala berbeda membuat kontur loss memanjang elips yang menyebabkan osilasi lambat pada pembaruan gradien.',
            ]
        );

        // Lesson 5 (Locked Roadmap Node)
        Lesson::updateOrCreate(
            ['slug' => 'membangun-neuron-perceptron-dari-nol'],
            [
                'track_id' => $track1->id,
                'title' => 'Proyek Praktik: Membangun Neuron Buatan Pertama (Perceptron) dari Nol',
                'order' => 5,
                'xp_reward' => 150,
                'estimated_minutes' => 20,
                'summary' => 'Gabungkan semua pengetahuan NumPy untuk memprogram model Perceptron lengkap: inisialisasi bobot, forward pass dot product, fungsi aktivasi step, dan aturan update bobot.',
                'analogy_title' => 'Logika Dunia Nyata: Saklar Keputusan Otomatis Otak Digital',
                'analogy_content' => 'Materi proyek sintesis perceptron.',
                'library_name' => 'NumPy Custom Perceptron Engine',
                'library_why' => 'Fondasi paling murni untuk memahami bagaimana deep learning bekerja di balik layar tanpa bantuan framework hitam (black-box).',
                'library_concepts' => [
                    ['name' => 'Forward Pass', 'desc' => 'Perhitungan output z = W · x + b dan aplikasi fungsi aktivasi'],
                    ['name' => 'Weight Update Rule', 'desc' => 'W_new = W_old + lr * (y_true - y_pred) * x'],
                ],
                'code_example' => "import numpy as np\nclass Perceptron:\n    def __init__(self, lr=0.1):\n        self.lr = lr\n        self.w = np.zeros(2)\n        self.b = 0.0",
                'challenge_question' => 'Apa yang terjadi pada pembaruan bobot Perceptron jika tebakan model (y_pred) sama persis dengan label sebenarnya (y_true)?',
                'challenge_options' => [
                    'Nilai error adalah nol, sehingga tidak ada perubahan pada bobot (W) maupun bias (b).',
                    'Bobot akan langsung direset menjadi nol secara otomatis.',
                    'Model akan membuang seluruh sampel data dan berhenti berlatih selamanya.',
                    'Nilai learning rate akan meningkat secara eksponensial.',
                ],
                'challenge_correct_index' => 0,
                'challenge_explanation' => 'Ketika prediksi benar (error = 0), suku pembaruan gradien bernilai nol sehingga bobot tetap konstan.',
            ]
        );

        // 3. Seed Achievements
        $achievements = [
            [
                'code' => 'matrix_novice',
                'title' => 'Matrix Novice',
                'description' => 'Menyelesaikan modul pertama: Fondasi Data NumPy & Vektorisasi.',
                'icon' => 'layers',
                'category' => 'Foundations',
                'xp_reward' => 50,
            ],
            [
                'code' => 'streak_pioneer',
                'title' => 'Streak Pioneer',
                'description' => 'Berlatih secara konsisten dan aktif selama 3 hari beruntun.',
                'icon' => 'zap',
                'category' => 'Consistency',
                'xp_reward' => 75,
            ],
            [
                'code' => 'perfect_epoch',
                'title' => 'Perfect Epoch',
                'description' => 'Menjawab kuis lab dan tantangan kode tanpa kesalahan.',
                'icon' => 'check-circle',
                'category' => 'Mastery',
                'xp_reward' => 100,
            ],
            [
                'code' => 'gradient_conqueror',
                'title' => 'Gradient Conqueror',
                'description' => 'Menuntaskan seluruh modul Track Foundations of Machine Learning.',
                'icon' => 'trending-up',
                'category' => 'Deep Learning',
                'xp_reward' => 200,
            ],
        ];

        foreach ($achievements as $ach) {
            Achievement::updateOrCreate(['code' => $ach['code']], $ach);
        }
    }
}
