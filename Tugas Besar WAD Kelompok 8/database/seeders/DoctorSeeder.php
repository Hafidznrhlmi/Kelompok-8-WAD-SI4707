<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Carbon\Carbon;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'id' => 1,
                'name' => 'dr. Ahmad',
                'specialization' => 'Dokter Umum',
                'short_description' => 'Dokter umum berpengalaman dengan lebih dari 10 tahun praktik dalam menangani berbagai masalah kesehatan umum.',
                'full_description' => 'dr. Ahmad adalah seorang dokter umum yang telah berpraktik selama lebih dari 10 tahun. Beliau lulus dari Fakultas Kedokteran Universitas Indonesia dengan predikat cum laude. Spesialisasi dalam penanganan penyakit umum, medical check-up, dan konsultasi kesehatan. Beliau dikenal dengan pendekatan yang ramah dan teliti dalam mendiagnosa pasien. Aktif dalam berbagai seminar kesehatan dan terus mengikuti perkembangan ilmu kedokteran terkini.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
                'practice_start_time' => '08:00:00',
                'practice_end_time' => '16:00:00',
                'practice_days' => 'Senin - Jumat',
            ],
            [
                'id' => 2,
                'name' => 'dr. Siti',
                'specialization' => 'Spesialis Penyakit Dalam',
                'short_description' => 'Spesialis penyakit dalam dengan keahlian khusus dalam penanganan diabetes dan penyakit metabolik.',
                'full_description' => 'dr. Siti adalah spesialis penyakit dalam lulusan Universitas Gadjah Mada dengan pengalaman lebih dari 15 tahun. Beliau menyelesaikan pendidikan spesialis di RSCM Jakarta. Fokus praktik beliau meliputi penanganan diabetes, hipertensi, dan penyakit metabolik. Aktif dalam penelitian medis dan telah mempublikasikan berbagai artikel di jurnal kedokteran internasional. Pendekatan holistik dalam pengobatan menjadi ciri khas praktik beliau.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
                'practice_start_time' => '09:00:00',
                'practice_end_time' => '17:00:00',
                'practice_days' => 'Senin, Rabu, Jumat',
            ],
            [
                'id' => 3,
                'name' => 'dr. Budi',
                'specialization' => 'Spesialis Anak',
                'short_description' => 'Spesialis anak yang ramah dan berpengalaman dalam perawatan kesehatan anak dari bayi hingga remaja.',
                'full_description' => 'dr. Budi adalah spesialis anak dengan pengalaman lebih dari 12 tahun. Menyelesaikan pendidikan spesialis anak di Universitas Airlangga. Memiliki keahlian khusus dalam tumbuh kembang anak, imunisasi, dan penanganan penyakit anak. Dikenal dengan pendekatan yang ramah dan sabar dalam menangani pasien anak. Aktif dalam edukasi kesehatan anak dan parenting. Telah menangani ribuan kasus pediatri dengan tingkat kesuksesan yang tinggi.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
                'practice_start_time' => '10:00:00',
                'practice_end_time' => '18:00:00',
                'practice_days' => 'Selasa, Kamis, Sabtu',
            ],
            [
                'id' => 4,
                'name' => 'dr. Maya',
                'specialization' => 'Spesialis Kandungan dan Kebidanan',
                'short_description' => 'Spesialis kandungan berpengalaman dalam menangani kehamilan berisiko tinggi dan persalinan normal.',
                'full_description' => 'dr. Maya adalah spesialis kandungan dan kebidanan dengan pengalaman lebih dari 14 tahun. Lulus dari Universitas Indonesia dan menyelesaikan spesialisasi di RSCM. Memiliki keahlian khusus dalam penanganan kehamilan berisiko tinggi, persalinan normal dan caesar, serta masalah kesuburan. Aktif dalam penelitian di bidang kesehatan ibu dan anak. Pendekatan yang lembut dan profesional membuat pasien merasa nyaman dan aman.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'dr. Rudi',
                'specialization' => 'Spesialis Bedah',
                'short_description' => 'Spesialis bedah umum dengan keahlian dalam bedah minimal invasif dan laparoskopi.',
                'full_description' => 'dr. Rudi adalah spesialis bedah umum dengan pengalaman lebih dari 16 tahun. Menyelesaikan pendidikan di Universitas Padjadjaran dan spesialisasi bedah di RSHS Bandung. Memiliki keahlian khusus dalam bedah minimal invasif, laparoskopi, dan bedah onkologi. Telah melakukan ribuan prosedur bedah dengan tingkat keberhasilan tinggi. Aktif dalam pengembangan teknik bedah modern dan pelatihan bedah laparoskopi.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'dr. Nina',
                'specialization' => 'Spesialis Mata',
                'short_description' => 'Spesialis mata dengan keahlian dalam penanganan katarak dan penyakit retina.',
                'full_description' => 'dr. Nina adalah spesialis mata dengan pengalaman lebih dari 13 tahun. Lulus dari Universitas Diponegoro dan menyelesaikan spesialisasi di Singapore National Eye Centre. Memiliki keahlian khusus dalam operasi katarak, penanganan glaukoma, dan penyakit retina. Menggunakan teknologi terkini dalam diagnosis dan pengobatan. Aktif dalam penelitian penyakit mata dan telah mempublikasikan berbagai artikel ilmiah.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'dr. Andi',
                'specialization' => 'Spesialis THT',
                'short_description' => 'Spesialis THT dengan pengalaman dalam penanganan gangguan pendengaran dan penyakit saluran pernapasan.',
                'full_description' => 'dr. Andi adalah spesialis THT dengan pengalaman lebih dari 11 tahun. Lulus dari Universitas Hasanuddin dan menyelesaikan spesialisasi di RSCM Jakarta. Memiliki keahlian khusus dalam penanganan gangguan pendengaran, operasi hidung, dan penyakit saluran pernapasan. Menggunakan pendekatan modern dalam diagnosis dan pengobatan. Aktif dalam penelitian di bidang THT dan pengembangan teknik operasi minimal invasif.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'dr. Lisa',
                'specialization' => 'Spesialis Kulit dan Kelamin',
                'short_description' => 'Spesialis kulit dengan keahlian dalam dermatologi kosmetik dan penyakit kulit.',
                'full_description' => 'dr. Lisa adalah spesialis kulit dan kelamin dengan pengalaman lebih dari 10 tahun. Lulus dari Universitas Airlangga dan menyelesaikan spesialisasi di National Skin Centre Singapore. Memiliki keahlian khusus dalam dermatologi kosmetik, penanganan penyakit kulit, dan prosedur laser. Aktif dalam penelitian produk skincare dan pengembangan teknik perawatan kulit modern.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 9,
                'name' => 'dr. Deni',
                'specialization' => 'Spesialis Saraf',
                'short_description' => 'Spesialis saraf dengan fokus pada penanganan stroke dan gangguan neurologis.',
                'full_description' => 'dr. Deni adalah spesialis saraf dengan pengalaman lebih dari 15 tahun. Lulus dari Universitas Indonesia dan menyelesaikan spesialisasi di RSCM Jakarta. Memiliki keahlian khusus dalam penanganan stroke, epilepsi, dan penyakit neurologis degeneratif. Aktif dalam penelitian penyakit saraf dan pengembangan metode terapi neurologis. Menggunakan pendekatan holistik dalam pengobatan pasien.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 10,
                'name' => 'dr. Sarah',
                'specialization' => 'Spesialis Jantung',
                'short_description' => 'Spesialis jantung dengan keahlian dalam kardiologi intervensi dan penanganan penyakit jantung koroner.',
                'full_description' => 'dr. Sarah adalah spesialis jantung dengan pengalaman lebih dari 14 tahun. Lulus dari Universitas Gadjah Mada dan menyelesaikan spesialisasi di National Heart Centre Singapore. Memiliki keahlian khusus dalam kardiologi intervensi, penanganan penyakit jantung koroner, dan gagal jantung. Aktif dalam penelitian kardiologi dan pengembangan teknik intervensi jantung modern.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 11,
                'name' => 'dr. Hadi',
                'specialization' => 'Spesialis Gigi',
                'short_description' => 'Spesialis gigi dengan keahlian dalam ortodonti dan bedah mulut.',
                'full_description' => 'dr. Hadi adalah spesialis gigi dengan pengalaman lebih dari 12 tahun. Lulus dari Universitas Padjadjaran dan menyelesaikan spesialisasi di Tokyo Medical and Dental University. Memiliki keahlian khusus dalam ortodonti, bedah mulut, dan implant gigi. Menggunakan teknologi dental terkini dalam praktiknya. Aktif dalam pengembangan teknik perawatan gigi modern.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
            [
                'id' => 12,
                'name' => 'dr. Dewi',
                'specialization' => 'Spesialis Paru',
                'short_description' => 'Spesialis paru dengan keahlian dalam penanganan asma dan penyakit paru kronis.',
                'full_description' => 'dr. Dewi adalah spesialis paru dengan pengalaman lebih dari 13 tahun. Lulus dari Universitas Airlangga dan menyelesaikan spesialisasi di RSUD Dr. Soetomo. Memiliki keahlian khusus dalam penanganan asma, PPOK, dan tuberkulosis. Aktif dalam penelitian penyakit paru dan pengembangan metode terapi respirasi. Menggunakan pendekatan komprehensif dalam penanganan pasien paru.',
                'status' => 'active',
                'joined_date' => Carbon::now(),
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::updateOrCreate(
                ['id' => $doctor['id']],
                $doctor
            );
        }
    }
} 