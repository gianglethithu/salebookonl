<?php

namespace App\Console\Commands;

use App\Exports\GroupSaleExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GroupSale:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'export group sale';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Excel::store(new GroupSaleExport, 'public/sale.xlsx');
    }
}
