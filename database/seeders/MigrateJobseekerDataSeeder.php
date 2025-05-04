<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\JobseekerProfile;

class MigrateJobseekerDataSeeder extends Seeder
{
    /**
     * Run the database seeds to migrate existing data from users table to jobseeker_profiles.
     */
    public function run(): void
    {
        // Check if the users table still has the old columns
        $hasOldColumns = false;
        
        try {
            $hasOldColumns = DB::select("SHOW COLUMNS FROM users LIKE 'resume_path'");
        } catch (\Exception $e) {
            $this->command->info('Old columns not found in users table. No migration needed.');
            return;
        }
        
        if (!$hasOldColumns) {
            $this->command->info('Old columns not found in users table. No migration needed.');
            return;
        }
        
        // Get all jobseekers with potential profile data
        $jobseekers = DB::table('users')
            ->where('role', 'jobseeker')
            ->get();
        
        foreach ($jobseekers as $user) {
            $profile = JobseekerProfile::where('user_id', $user->id)->first();
            
            if ($profile) {
                $updates = [];
                
                // Check each field that might need migration
                if (property_exists($user, 'resume_path') && !empty($user->resume_path)) {
                    $updates['resume_path'] = $user->resume_path;
                }
                
                if (property_exists($user, 'portfolio_path') && !empty($user->portfolio_path)) {
                    $updates['portfolio_path'] = $user->portfolio_path;
                }
                
                if (property_exists($user, 'portfolio_description') && !empty($user->portfolio_description)) {
                    $updates['portfolio_description'] = $user->portfolio_description;
                }
                
                if (property_exists($user, 'skills') && !empty($user->skills)) {
                    $updates['skills'] = $user->skills;
                }
                
                if (property_exists($user, 'experience') && !empty($user->experience)) {
                    $updates['experience'] = $user->experience;
                }
                
                if (property_exists($user, 'education') && !empty($user->education)) {
                    $updates['education'] = $user->education;
                }
                
                // Update profile if we have data to migrate
                if (!empty($updates)) {
                    $profile->update($updates);
                    $this->command->info("Migrated profile data for user ID: {$user->id}");
                }
            }
        }
        
        $this->command->info('Jobseeker data migration completed successfully!');
    }
}
