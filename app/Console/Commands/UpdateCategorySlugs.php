<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UpdateCategorySlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:update-slugs {--force : Force update all slugs even if they exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật slug cho các danh mục chưa có slug hoặc slug rỗng';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Đang tìm kiếm các danh mục cần cập nhật slug...');

        // Tìm các category chưa có slug hoặc slug rỗng
        if ($this->option('force')) {
            $categories = Category::all();
            $this->warn('Chế độ force: Sẽ cập nhật tất cả slug (kể cả đã có)');
        } else {
            $categories = Category::whereNull('slug')
                ->orWhere('slug', '')
                ->get();
        }

        if ($categories->isEmpty()) {
            $this->info('Không có danh mục nào cần cập nhật slug.');
            return Command::SUCCESS;
        }

        $this->info("Tìm thấy {$categories->count()} danh mục cần cập nhật.");
        
        $bar = $this->output->createProgressBar($categories->count());
        $bar->start();

        $updated = 0;
        $skipped = 0;

        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                // Bỏ qua nếu đã có slug và không phải force mode
                if (!$this->option('force') && !empty($category->slug)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                // Tạo slug từ name
                $baseSlug = Str::slug($category->name);
                
                // Kiểm tra slug trùng và tạo slug unique
                $slug = $this->makeUniqueSlug($baseSlug, $category->id);
                
                // Cập nhật slug
                $category->slug = $slug;
                $category->saveQuietly(); // Dùng saveQuietly để không trigger events
                
                $updated++;
                $bar->advance();
            }

            DB::commit();
            $bar->finish();
            $this->newLine(2);
            
            $this->info("✓ Đã cập nhật {$updated} danh mục thành công!");
            if ($skipped > 0) {
                $this->comment("  (Bỏ qua {$skipped} danh mục đã có slug)");
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
            $exists = Category::where('slug', $slug)
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
