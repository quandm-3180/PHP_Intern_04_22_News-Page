<?php

namespace App\Console\Commands;

use App\Mail\PostStatisticsMail;
use App\Mail\TestSendMail;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailPostStatisticsCommand extends Command
{
    protected $userRepo;
    protected $postRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email-statistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send post statistics to the writer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        PostRepositoryInterface $postRepo
    ) {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $writers = $this->userRepo->getWrites();

        foreach ($writers as $writer) {
            $posts = $this->postRepo->getPostByWriterInCurrentWeek($writer->id);
            $mail = new PostStatisticsMail($writer, $posts);
            Mail::to($writer->email)->queue($mail);
        }

        return true;
    }
}
