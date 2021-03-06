<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bid, App\Auction;

class BidController extends Controller 
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'amount' => 'required|integer',
      'auctionId' => 'required|integer',
    ]);

    $auction = Auction::where('id', $request->auctionId)->first();
    // only allow bidding on active auctions
    if (!$auction->isActive())
    {
      return back()->withErrors(['You can only bid on active auctions.']);
    }
    // check if bid is higher than current highest bid
    if ($request->amount < $auction->highestBidAmount())
    {
      return back()->withErrors(['Your bid must be higher than the current highest bid.']);
    }
    // check if bid is higher than the minimum price
    if ($request->amount < $auction->priceMinEst)
    {
      return back()->withErrors(['Your bid cannot be lower than the minimum estimated price.']);
    }
    // check if the bid isn't higher than the buyout
    if ($request->amount > $auction->priceBuyout)
    {
      return back()->withErrors(['Your bid is higher than the buyout price, please press the "buy now" button.']);
    }

    Bid::create([
      'userId' => \Auth::id(),
      'auctionId' => $request->auctionId,
      'amount' => $request->amount,
    ]);

    return back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

  public function buyout($auctionId)
  {
    $auction = Auction::where('id', $auctionId)->first();
    // only allow buying active auctions
    if (!$auction->isActive())
    {
      return back()->withErrors(['You can only buy active auctions.']);
    }

    Bid::create([
      'userId' => \Auth::id(),
      'auctionId' => $auctionId,
      'amount' => $auction->priceBuyout,
    ]);

    $auction->boughtBy = \Auth::id();
    $auction->status = "sold";
    $auction->save();

    //future: redirect to thank you page
  }
  
}

?>