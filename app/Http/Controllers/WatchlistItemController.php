<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\WatchlistItem;

class WatchlistItemController extends Controller 
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
  public function index(Request $request)
  {
    $filters = ['show' => $request->query('show', 'all')];

    $watchlistItems = \Auth::user()->watchlistItems($filters);

    return view('watchlist.index', ['watchlistItems' => $watchlistItems]);
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
      'auctionId' => 'required|integer',
    ]);

    // if already on watchlist, remove item
    $watchlistItem = WatchlistItem::where([['userId', \Auth::id()],['auctionId', $request->auctionId]])->first();
    if ($watchlistItem)
    {
      $watchlistItem->delete();
      return back();
    }

    // add item
    WatchlistItem::create([
      'userId' => \Auth::id(),
      'auctionId' => $request->auctionId,
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
  public function destroy(Request $request, $id)
  {
    foreach ($request->delete_items as $item)
    {
      $watchlistItem = WatchlistItem::where('auctionId', $item)->first();
      if ($watchlistItem->userId == \Auth::id())
      {
        $watchlistItem->delete();
      }
    }
    return back();
  }

  public function clear()
  {
    WatchlistItem::where('userId', \Auth::id())->delete();

    return back();
  }
  
}

?>