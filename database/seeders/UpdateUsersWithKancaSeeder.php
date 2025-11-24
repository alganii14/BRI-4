<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RMFT;
use App\Models\Uker;
use Illuminate\Support\Facades\Hash;

class UpdateUsersWithKancaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Updating RMFT users with Kanca data...");
        
        // Update all RMFT users with their Kanca
        $rmftUsers = User::where('role', 'rmft')->whereNotNull('rmft_id')->get();
        
        foreach ($rmftUsers as $user) {
            if ($user->rmftData) {
                $user->update([
                    'kode_kanca' => $user->rmftData->ukerRelation->kode_kanca ?? null,
                    'nama_kanca' => $user->rmftData->kanca ?? null,
                ]);
            }
        }
        
        $this->command->info("✓ Updated {$rmftUsers->count()} RMFT users with Kanca data");
        
        // Create Manager accounts per Kanca
        $this->command->info("\nCreating Manager accounts per Kanca...");
        
        $kancaList = RMFT::select('kanca')
                        ->distinct()
                        ->whereNotNull('kanca')
                        ->orderBy('kanca', 'asc')
                        ->get();
        
        $created = 0;
        
        foreach ($kancaList as $kancaData) {
            $kanca = $kancaData->kanca;
            
            // Get Uker data for this Kanca - try exact match first
            $uker = Uker::where('kanca', $kanca)->first();
            
            // If not found, try similar match (untuk kasus seperti Soekarno vs Sukarno)
            if (!$uker) {
                // Coba variasi ejaan umum
                $variations = [
                    str_replace('Soekarno', 'Sukarno', $kanca),
                    str_replace('Soeharto', 'Suharto', $kanca),
                ];
                
                foreach ($variations as $variation) {
                    $uker = Uker::where('kanca', $variation)->first();
                    if ($uker) {
                        $this->command->info("📝 Found variant: '{$variation}' for '{$kanca}'");
                        break;
                    }
                }
            }
            
            if (!$uker) {
                $this->command->warn("⚠️  Skipping {$kanca} - no Uker data found");
                continue;
            }
            
            // Check if manager already exists
            $existingManager = User::where('role', 'manager')
                                   ->where('nama_kanca', $kanca)
                                   ->first();
            
            if ($existingManager) {
                $this->command->info("⏭️  Skipping {$kanca} - manager already exists");
                continue;
            }
            
            // Create manager email
            $email = 'manager.' . strtolower(str_replace([' ', '.'], '', $kanca)) . '@bri.co.id';
            
            User::create([
                'name' => 'Manager ' . $kanca,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'manager',
                'kode_kanca' => $uker->kode_kanca,
                'nama_kanca' => $kanca,
            ]);
            
            $this->command->info("✓ Created: {$email} - {$kanca}");
            $created++;
        }
        
        $this->command->info("\n✅ Successfully created {$created} Manager accounts");
        $this->command->info("\n📋 Manager accounts created with:");
        $this->command->info("   Email format: manager.[kanca]@bri.co.id");
        $this->command->info("   Password: password");
        $this->command->info("\nExample:");
        $this->command->info("   Email: manager.kcbandungdago@bri.co.id");
        $this->command->info("   Password: password");
    }
}
