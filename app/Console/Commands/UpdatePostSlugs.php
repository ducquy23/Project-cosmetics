<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UpdatePostSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:update-slugs {--force : Force update all slugs even if they exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật slug cho các bài viết chưa có slug hoặc slug rỗng';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Đang tìm kiếm các bài viết cần cập nhật slug...');

        // Tìm các post chưa có slug hoặc slug rỗng
        if ($this->option('force')) {
            $posts = Post::all();
            $this->warn('Chế độ force: Sẽ cập nhật tất cả slug (kể cả đã có)');
        } else {
            $posts = Post::whereNull('slug')
                ->orWhere('slug', '')
                ->get();
        }

        if ($posts->isEmpty()) {
            $this->info('Không có bài viết nào cần cập nhật slug.');
            return Command::SUCCESS;
        }

        $this->info("Tìm thấy {$posts->count()} bài viết cần cập nhật.");
        
        $bar = $this->output->createProgressBar($posts->count());
        $bar->start();

        $updated = 0;
        $skipped = 0;

        DB::beginTransaction();
        try {
            foreach ($posts as $post) {
                // Bỏ qua nếu đã có slug và không phải force mode
                if (!$this->option('force') && !empty($post->slug)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                // Tạo slug từ title
                $baseSlug = Str::slug($post->title);
                
                // Kiểm tra slug trùng và tạo slug unique
                $slug = $this->makeUniqueSlug($baseSlug, $post->id);
                
                // Cập nhật slug
                $post->slug = $slug;
                $post->saveQuietly(); // Dùng saveQuietly để không trigger events
                
                $updated++;
                $bar->advance();
            }

            DB::commit();
            $bar->finish();
            $this->newLine(2);
            
            $this->info("✓ Đã cập nhật {$updated} bài viết thành công!");
            if ($skipped > 0) {
                $this->comment("  (Bỏ qua {$skipped} bài viết đã có slug)");
            }
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $bar->finish();
            $this->newLine(2);
            $this->error("✗ Lỗi: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Tạo slug unique bằng cách thêm số vào cuối nếu trùng
     */
    protected function makeUniqueSlug($baseSlug, $excludeId = null)
    {
        $slug = $baseSlug;
        $counter = 1;

        while (true) {
            $exists = Post::where('slug', $slug)
                ->when($excludeId, function ($query) use ($excludeId) {
                    return $query->where('id', '!=', $excludeId);
                })
                ->exists();

            if (!$exists) {
                break;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
