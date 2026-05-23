<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Total Aset: " . \App\Models\Aset::count() . "\n";
echo "Total Kategori: " . \App\Models\Kategori::count() . "\n";
echo "\nData Aset:\n";
\App\Models\Aset::all()->each(function($aset) {
    echo "- {$aset->kode_aset}: {$aset->nama_aset}\n";
});
