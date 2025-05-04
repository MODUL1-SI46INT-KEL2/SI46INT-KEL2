<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\JobseekerProfile;

class JobseekerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all jobseekers
        $jobseekers = User::where('role', 'jobseeker')->get();
        
        foreach ($jobseekers as $user) {
            // Check if user already has a profile
            $existingProfile = JobseekerProfile::where('user_id', $user->id)->first();
            
            if (!$existingProfile) {
                // Create a new profile for the user
                JobseekerProfile::create([
                    'user_id' => $user->id,
                    'available_for_hire' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->command->info("Created profile for user ID: {$user->id}");
            }
        }
        
        $this->command->info('Jobseeker profiles created successfully!');
    }
}
