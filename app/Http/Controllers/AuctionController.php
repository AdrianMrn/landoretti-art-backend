<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Auction, App\Style;

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
  public function index()
  {
    $auctions = Auction::where('status', 'active')->orderBy('created_at')->paginate(8);

    return view('auctions.index', ['auctions' => $auctions]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $styles = Style::orderBy('name')->get();
    return view('auctions.create')->with('styles', $styles);
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

    dd("nice");
    //redirect user to newly made auction page
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
    return view('auctions.detail')->with('auction', $auction);
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