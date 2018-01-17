<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\Auction, App\Bid, App\User;

class checkauctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:checkauctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if auctions should expire';

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
     * @return mixed
     */
    public function handle()
    {
        echo "Check auctions started\n";

        $auctions = Auction::where('status', 'active')->get();

        foreach ($auctions as $auction) {
            if (Carbon::now()->timestamp > strtotime($auction->endDate)) {
                $this->endOfAuction($auction);
            }
        }
        $this->endOfAuction(Auction::where('id', 11)->first());


        echo "\nCheck auctions finished\n";
    }

    private function endOfAuction($auction)
    {
        echo "\Auction ending!\n";
        $auctionObject = Auction::where('id',$auction->id)->first();
        if (!$auctionObject->amountOfBids())
        {
            // no bids, auction expires
            $auction->status = 'expired';
            $auction->save();
        } else
        {
            $winningBid = $auctionObject->auctionWinner();
            $winner = User::where('id', $winningBid->userId)->first();

            Mail::to($winner)->send(new \App\Mail\AuctionWon($auction));
            
            $allBids = $auctionObject->auctionParticipants();
            $sendto = [];
            foreach ($allBids as $bid)
            {
                if ($bid->userId != $winningBid->userId)
                {
                    array_push($sendto, User::where('id', $bid->userId)->first());
                }
            }
            if (sizeof($sendto))
            {
                Mail::to($sendto)->send(new \App\Mail\AuctionLost($auction));
            }

            $auction->status = 'sold';
            $auction->boughtBy = $winner->id;
            $auction->save();
        }
    }
}
