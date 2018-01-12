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
      'auctionid' => 'required|integer',
    ]);

    $auction = Auction::where('id', $request->auctionid)->first();
    // only allow bidding on active auctions
    if (!$auction->isActive())
    {
      return back();
    }

    // check if bid is higher than current highest bid
    if ($request->amount < $auction->highestBidAmount())
    {
      return back()->withErrors(['Your bid must be higher than the current highest bid.']);
    }

    Bid::create([
      'userId' => \Auth::id(),
      'auctionId' => $request->auctionid,
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
  
}

?>