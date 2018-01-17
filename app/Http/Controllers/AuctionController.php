<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Auction, App\Style, App\WatchlistItem;

class AuctionController extends Controller 
{

  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index','show']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // filters
    $filters = array(
      'sortby' => $request->input('sortby', 'soonest'),
      'price' => $request->input('price', 'any'),
      'ending' => $request->input('ending', 'any'),
      'era' => $request->input('era', 'any'),
      'style' => $request->input('style', 'any'),
    );

    $query = $this->filterAuctions($filters);
    $auctions = $query->where('status', 'active')->paginate(8);

    $styles = Style::orderBy('name')->get();

    return view('auctions.index', ['title' => __('messages.art'), 'auctions' => $auctions, 'styles' => $styles, 'filters' => $filters]);
  }

  private function filterAuctions($filters)
  {
    $Auction = new Auction();
    $query = $Auction->newQuery();

    // sortby
    switch ($filters['sortby'])
    {
      case "soonest":
        $query->orderBy('endDate', 'asc');
        break;
      case "latest":
        $query->orderBy('endDate', 'desc');
        break;
      case "newest":
        $query->orderBy('created_at', 'asc');
        break;
      default:
        $query->orderBy('endDate', 'asc');
    }
    
    // price
    if ($filters['price'] == 'above')
    {
      $query->where('priceMinEst', '>', 100000);
    } elseif ($filters['price'] != 'any')
    {
      $values = explode('-', $filters['price']);
      $query->whereBetween('priceMaxEst', [(int)$values[0], (int)$values[1]]);
    }

    // ending
    switch ($filters['ending'])
    {
      case "today":
        $query->where('endDate',Carbon::now()->format('Y-m-d'));
        break;
      case "week":
        $query->where('endDate','<',Carbon::now()->addWeek()->format('Y-m-d'));
        break;
      case "month":
        $query->where('endDate','<',Carbon::now()->addMonth()->format('Y-m-d'));
        break;
    }

    // era
    switch ($filters['era'])
    {
      case 'lt-1940':
        $query->where('year', '<=', 1940);
        break;
      case '1940-1960':
        $query->whereBetween('year', [1940, 1960]);
        break;
      case '1960-1990':
      $query->whereBetween('year', [1960, 1990]);
        break;
      case '1990-now':
        $query->where('year', '>=', 1990);
        break;
    }

    // style
    if ($filters['style'] != 'any')
    {
      $query->where('style', $filters['style']);
    }

    return $query;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $styles = Style::orderBy('name')->get();

    return view('auctions.create', ['styles' => $styles]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'style' => 'required|string|max:255',
      'title' => 'required|string|max:255|unique:auctions',
      'year' => 'required|integer',
      'width' => 'required|integer',
      'height' => 'required|integer',
      'depth' => 'nullable|integer',
      'description' => 'required|string',
      'condition' => 'required|string',
      'origin' => 'required|string',
      'priceMinEst' => 'required|integer',
      'priceMaxEst' => 'required|integer',
      'priceBuyout' => 'nullable|integer',
      'endDate' => 'required|date_format:Y/m/d',
      'imageSignature' => 'required|image|max:10240',
      'imageArtwork' => 'required|image|max:10240',
      'imageOptional' => 'nullable|image|max:10240',
    ]);

    //extra validation
    if (strtotime($request->endDate) < Carbon::now()->timestamp)
    {
      return back()->withErrors(['The end date must be in the future.'])->withInput();
    }
    if ($request->priceMaxEst < $request->priceMinEst)
    {
      return back()->withErrors(['The maximum estimated price must be higher than the minimum estimated price.'])->withInput();
    } 
    if ($request->priceBuyout < $request->priceMaxEst)
    {
      return back()->withErrors(['The buyout price must be higher than the maximum estimated price.'])->withInput();
    } 
    if ($request->year > Carbon::now()->year)
    {
      return back()->withErrors(['The artwork probably was not made in the future, check again.'])->withInput();
    } 

    $imageSignature = $request->imageSignature;
    $imageArtwork = $request->imageArtwork;
    $imageOptional = $request->imageOptional;

    $timestamp = Carbon::now()->timestamp;

    $imageSignatureTitle = $timestamp . $imageSignature->getClientOriginalName();
    $imageArtworkTitle = $timestamp . $imageArtwork->getClientOriginalName();
    
    $imageSignature->move('uploads', $imageSignatureTitle);
    $imageArtwork->move('uploads', $imageArtworkTitle);
    $imageOptionalUrl = null;
    if (isset($request->imageOptional))
    {
      $imageOptionalTitle = $timestamp . $imageOptional->getClientOriginalName();
      $imageOptional->move('uploads', $imageOptionalTitle);
      $imageOptionalUrl = 'uploads/' . $imageOptionalTitle;
    }

    Auction::create([
      'userId' => \Auth::id(),
      'style' => $request->style,
      'title' => $request->title,
      'year' => $request->year,
      'width' => $request->width,
      'height' => $request->height,
      'depth' => $request->depth,
      'description' => $request->description,
      'condition' => $request->condition,
      'origin' => $request->origin,
      'priceMinEst' => $request->priceMinEst,
      'priceMaxEst' => $request->priceMaxEst,
      'priceBuyout' => $request->priceBuyout,
      'endDate' => $request->endDate,
      'boughtBy' => $request->boughtBy,
      'imageSignature' => 'uploads/' . $imageSignatureTitle,
      'imageArtwork' => 'uploads/' . $imageArtworkTitle,
      'imageOptional' => $imageOptionalUrl,
    ]);

    return redirect()->route('auctions.show', ['title' => $request->title]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($title)
  {
    $auction = Auction::where('title', $title)->first();
    
    // check if this auction is already on the user's watchlist
    $onWatchlist = false;
    if (\Auth::check() && WatchlistItem::where([['userId', \Auth::id()],['auctionId', $auction->id]])->first())
    {
      $onWatchlist = true;
    }

    return view('auctions.detail', ['auction' => $auction, 'onWatchlist' => $onWatchlist]);
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

  public function myAuctions()
  {
    return view('myauctions.index', ['auctions' => Auction::where('userId', \Auth::id())->get()]);
  }
  
}

?>