<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Data User ===\n";
$users = \App\Models\User::all();
foreach($users as $u) {
    echo "- {$u->name} ({$u->email}) - Role: {$u->role}\n";
}
