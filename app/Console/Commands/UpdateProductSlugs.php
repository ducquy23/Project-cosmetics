<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UpdateProductSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:update-slugs {--force : Force update all slugs even if they exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật slug cho các sản phẩm chưa có slug hoặc slug rỗng';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Đang tìm kiếm các sản phẩm cần cập nhật slug...');

        // Tìm các product chưa có slug hoặc slug rỗng
        if ($this->option('force')) {
            $products = Product::all();
            $this->warn('Chế độ force: Sẽ cập nhật tất cả slug (kể cả đã có)');
        } else {
            $products = Product::whereNull('slug')
                ->orWhere('slug', '')
                ->get();
        }

        if ($products->isEmpty()) {
            $this->info('Không có sản phẩm nào cần cập nhật slug.');
            return Command::SUCCESS;
        }

        $this->info("Tìm thấy {$products->count()} sản phẩm cần cập nhật.");
        
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $updated = 0;
        $skipped = 0;

        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                // Bỏ qua nếu đã có slug và không phải force mode
                if (!$this->option('force') && !empty($product->slug)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                // Tạo slug từ name
                $baseSlug = Str::slug($product->name);
                
                // Kiểm tra slug trùng và tạo slug unique
                $slug = $this->makeUniqueSlug($baseSlug, $product->id);
                
                // Cập nhật slug
                $product->slug = $slug;
                $product->saveQuietly(); // Dùng saveQuietly để không trigger events
                
                $updated++;
                $bar->advance();
            }

            DB::commit();
            $bar->finish();
            $this->newLine(2);
            
            $this->info("✓ Đã cập nhật {$updated} sản phẩm thành công!");
            if ($skipped > 0) {
                $this->comment("  (Bỏ qua {$skipped} sản phẩm đã có slug)");
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
            $exists = Product::where('slug', $slug)
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
