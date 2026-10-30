<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Interaksi;
use App\Models\Karya;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyInteractionsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('role', ['kreator', 'pengunjung'])->orderBy('id')->get();
        if ($users->isEmpty()) return;

        Interaksi::where('isi_interaksi', 'like [Dummy Seed]')->delete();
        Interaksi::where('isi_interaksi', 'like Dummy Seed')->delete();

        $comments = [
            'Karyanya terasa hangat dan mudah dinikmati.',
            'Detailnya bagus, terus berkarya!',
            'Pesannya sampai dengan kuat dan menyentuh.',
            'Aku suka suasana yang dibangun oleh karya ini.',
        ];
        $notes = [
            'Bagian ini terasa paling memorable untukku.',
            'Sederhana, tapi punya makna yang dalam.',
            'Aku akan membagikan karya ini kepada teman-teman.',
        ];

        $works = Karya::where('status', 'aktif')->orderBy('id')->get();
        Interaksi::where('isi_interaksi', 'like [Dummy Seed]')->delete();
        Interaksi::where('isi_interaksi', 'like Dummy Seed')->delete();
        Interaksi::where('isi_interaksi', 'like [Dummy Seed]')->delete();

        foreach ($works as $index => $work) {
            $writers = $users->count();
            $likeCount = 15 + (($index * 3) % 8);
            for ($i = 0; $i < $likeCount; $i++) {
                Interaksi::create([
                    'id_users' => $users[$i % $writers]->id,
                    'id_karya' => $work->id,
                    'jenis_interaksi' => 'like',
                    'isi_interaksi' => 'like',
                ]);
            }
            if ($index < 12 || !str_starts_with((string) $work->judul, '[')) {
                for ($i = 0; $i < 4; $i++) {
                    Interaksi::create([
                        'id_users' => $users[($i + $index) % $writers]->id,
                        'id_karya' => $work->id,
                        'jenis_interaksi' => 'komentar',
                        'isi_interaksi' => $comments[$i],
                        'tipe_komentar' => ['pujian', 'pujian', 'kritik', 'tanya'][$i],
                    ]);
                }
                for ($i = 0; $i < 3; $i++) {
                    Interaksi::create([
                        'id_users' => $users[($i + $index + 1) % $writers]->id,
                        'id_karya' => $work->id,
                        'jenis_interaksi' => 'catatan_tempel',
                        'isi_interaksi' => $notes[$i],
                    ]);
                }
            }
        }

        foreach (Event::all() as $index => $event) {
            for ($i = 0; $i < 4; $i++) {
                Interaksi::firstOrCreate([
                    'id_users' => $users[($i + $index) % $users->count()]->id,
                    'id_event' => $event->id,
                    'jenis_interaksi' => 'komentar',
                    'isi_interaksi' => $comments[$i],
                ], ['tipe_komentar' => 'pujian']);
            }
        }
    }
}
